<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\Category;
use App\Models\nutritions;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Tenants
        $this->call(TenantSeeder::class);

        // Seed Categories
        $this->seedCategories();

        // // Seed Products
        $this->seedProducts();

        // // Seed Orders and OrderProducts
        // $this->call(OrdersAndOrderProductsTableSeeder::class);
    }

    private function seedCategories()
    {
        Category::create(['name' => 'Makanan']);
        Category::create(['name' => 'Minuman']);
    }

    private function seedProducts()
    {
        $productData = [
            // Add your product data here...
            // Example:
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Ayam Geprek',
                'price' => '10000',
                'image' => 'food2.png',
                'description' => 'Ayam goreng tepung yang digeprek',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 250,
                    'karbohidrat' => 30,
                    'protein' => 15,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Tahu Tek Telor',
                'price' => '10000',
                'image' => 'food3.png',
                'description' => 'Tahu Tek bumbu kacang plus telor',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 150,
                    'karbohidrat' => 20,
                    'protein' => 8,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Nasi Pecel',
                'price' => '10000',
                'image' => 'food4.png',
                'description' => 'Nasi Pecel lauk telor tempe',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 200,
                    'karbohidrat' => 35,
                    'protein' => 10,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Nasi Rames',
                'price' => '8000',
                'image' => 'food6.png',
                'description' => 'Nasi Rames biasa bonus kerupuk',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 250,
                    'karbohidrat' => 35,
                    'protein' => 10,
                ],
            ],
            // Add other products similarly...
        ];

        foreach ($productData as $product) {
            $imagePath = storage_path('app/public/images/products/' . $product['image']);
            if (File::exists($imagePath)) {
                $createdProduct = Product::create([
                    'category_id' => $product['category_id'],
                    'tenant_id' => $product['tenant_id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => 'images/products/' . $product['image'],
                    'description' => $product['description'],
                    'status' => $product['status'],
                ]);

                nutritions::create([
                    'product_id' => $createdProduct->id,
                    'kalori' => $product['nutritions']['kalori'] ?? null,
                    'lemak' => $product['nutritions']['lemak'] ?? null,
                    'gula' => $product['nutritions']['gula'] ?? null,
                    'karbohidrat' => $product['nutritions']['karbohidrat'] ?? null,
                    'protein' => $product['nutritions']['protein'] ?? null,
                ]);
            } else {
                echo "File gambar tidak ditemukan: {$product['image']}\n";
            }
        }
    }
}
