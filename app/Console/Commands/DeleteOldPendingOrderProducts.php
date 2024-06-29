<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderProduct;
use Carbon\Carbon;

class DeleteOldPendingOrderProducts extends Command
{
    protected $signature = 'orderproducts:delete-old-pending';
    protected $description = 'Delete order products that are pending for more than 30 seconds';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Ambil semua produk order yang statusnya Pending lebih dari 30 detik
        $pendingProducts = OrderProduct::where('orderProductStatus', 'Pending')
            ->where('created_at', '<', Carbon::now()->subSeconds(30))
            ->get();

        foreach ($pendingProducts as $product) {
            $product->delete();
        }

        $this->info('Old pending order products deleted successfully.');
    }
}


