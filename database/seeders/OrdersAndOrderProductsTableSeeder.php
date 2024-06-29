<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrdersAndOrderProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $productIds = Product::pluck('id')->toArray();
        $tenantIds = Tenant::pluck('id_tenant')->toArray(); // Ganti 'id' dengan 'id_tenant'
        $orderStatus = ['Uncompleted', 'Completed'];
        $paymentMethods = ['tunai', 'non-tunai'];
        $productStatus = ['Pending', 'Cancelled', 'In Progress', 'Completed'];

        for ($i = 0; $i < 50; $i++) {
            $orderDate = Carbon::now()->subMonths(rand(0, 11))->subDays(rand(0, 30));
            $order = Order::create([
                'uid' => Str::uuid(),
                'orderName' => 'Customer ' . $i,
                'orderPhone' => '08123456789' . $i,
                'orderNotes' => 'Catatan order ' . $i,
                'orderTotalAmounts' => rand(100000, 1000000),
                'orderStatus' => $orderStatus[array_rand($orderStatus)],
                'orderPayment' => $paymentMethods[array_rand($paymentMethods)],
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            $orderProductCount = rand(1, 5);
            for ($j = 0; $j < $orderProductCount; $j++) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $productIds[array_rand($productIds)],
                    'tenant_id' => $tenantIds[array_rand($tenantIds)], // Pastikan menggunakan 'id_tenant'
                    'quantity' => rand(1, 10),
                    'price' => rand(10000, 100000),
                    'orderProductStatus' => $productStatus[array_rand($productStatus)],
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);
            }
        }
    }
}
