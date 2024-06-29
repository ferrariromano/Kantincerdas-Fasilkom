<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderProduct;
use App\Models\Order;
use Carbon\Carbon;

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

        $pendingProducts = OrderProduct::where('orderProductStatus', 'Pending')
            ->where('created_at', '<', Carbon::now()->subSeconds(30))
            ->get();


        $orderIds = [];

        foreach ($pendingProducts as $product) {
            $orderIds[] = $product->order_id;
            $product->delete();
        }

        $emptyOrders = Order::whereDoesntHave('orderProducts')->whereIn('id', $orderIds)->get();


        foreach ($emptyOrders as $order) {
            $order->delete();
        }

        $this->info('Pending order products older than 30 seconds have been deleted.');
    }
}



