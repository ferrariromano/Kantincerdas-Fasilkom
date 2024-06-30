<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderProduct;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeletePendingOrderProducts extends Command
{
    protected $signature = 'orderproducts:delete-old-pending';
    protected $description = 'Delete order products that are pending for more than 30 seconds';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::beginTransaction();

        try {
            $orderIds = [];

            OrderProduct::where('orderProductStatus', 'Pending')
                ->where('created_at', '<', Carbon::now()->subSeconds(30))
                ->chunkById(100, function ($pendingProducts) use (&$orderIds) {
                    foreach ($pendingProducts as $product) {
                        $orderIds[] = $product->order_id;
                        $product->delete();
                    }
                });

            $emptyOrders = Order::whereDoesntHave('orderProducts')
                ->whereIn('id', $orderIds)
                ->get();

            foreach ($emptyOrders as $order) {
                $order->delete();
            }

            DB::commit();

            $this->info('Pending order products older than 30 seconds have been deleted.');
            Log::info('Pending order products older than 30 seconds have been deleted.', ['orderIds' => $orderIds]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('An error occurred: ' . $e->getMessage());
            Log::error('Error deleting pending order products.', ['error' => $e->getMessage()]);
        }
    }
}



