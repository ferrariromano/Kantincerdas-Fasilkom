<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Product;
use App\Models\Category;
use App\Models\nutritions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TenantSeeder::class);

        Category::create([
            'name' => 'Makanan',
        ]);

        Category::create([
            'name' => 'Minuman',
        ]);

        $productData = [
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'pecel medium tempe ',
                'price' => '13000',
                'image' => 'food1.png',
                'description' => 'Soto gabung Sate pasti mantap. Masakan khas Indonesia yang terdiri atas kombinasi dua jenis makanan menjadi satu hidangan yang unik di lidah, yaitu kombinasi antara soto dan sate ayam di atasnya dengan racikan bumbu khas Indonesia yang menjadikannya unik untuk dirasakan.',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 200,
                    'karbohidrat' => 25,
                    'protein' => 10,
                ],
            ],
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
                'tenant_id' => '2',
                'name' => 'Nasi Campur',
                'price' => '8000',
                'image' => 'food5.png',
                'description' => 'Nasi Campur isi macem-macem',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 300,
                    'karbohidrat' => 40,
                    'protein' => 12,
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
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Nasi Goreng',
                'price' => '8000',
                'image' => 'food7.png',
                'description' => 'Nasi Goreng original plus telor',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 300,
                    'karbohidrat' => 45,
                    'protein' => 12,
                ],
            ],
            [
                'category_id' => '2',
                'tenant_id' => '1',
                'name' => 'Es Teh',
                'price' => '4000',
                'image' => 'drink1.jpg',
                'description' => 'Es Teh manis kek kamu',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 100,
                    'lemak' => 0,
                    'gula' => 25,
                ],
            ],
            [
                'category_id' => '2',
                'tenant_id' => '2',
                'name' => 'Es Jeruk',
                'price' => '5000',
                'image' => 'drink2.jpg',
                'description' => 'Es Jeruk bisa manis bisa kecut tergantung hoki',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 120,
                    'lemak' => 0,
                    'gula' => 30,
                ],
            ]
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
