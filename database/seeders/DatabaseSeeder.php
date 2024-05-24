<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Category::create([
            'name' => 'Makanan',
        ]);

        Category::create([
            'name' => 'Minuman',
        ]);

        $productData = [
            [
                'category_id' => '1',
                'name' => 'Soto Sate',
                'price' => '13000',
                'image' => 'food1.png',
                'description' => 'Soto gabung Sate pasti mantap',
                'status' =>  'aktif',
            ],
            [
                'category_id' => '1',
                'name' => 'Ayam Geprek',
                'price' => '10000',
                'image' => 'food2.png',
                'description' => 'Ayam goreng tepung yang digeprek',
                'status' =>  'aktif',
            ],
            [
                'category_id' => '1',
                'name' => 'Tahu Tek Telor',
                'price' => '10000',
                'image' => 'food3.png',
                'description' => 'Tahu Tek bumbu kacang plus telor',
                'status' =>  'aktif',
            ],
            [
                'category_id' => '1',
                'name' => 'Nasi Pecel',
                'price' => '10000',
                'image' => 'food4.png',
                'description' => 'Nasi Pecel lauk telor tempe',
                'status' =>  'aktif',
            ],
            [
                'category_id' => '1',
                'name' => 'Nasi Campur',
                'price' => '8000',
                'image' => 'food5.png',
                'description' => 'Nasi Campur isi macem-macem',
                'status' =>  'aktif',
            ],
            [
                'category_id' => '1',
                'name' => 'Nasi Rames',
                'price' => '8000',
                'image' => 'food6.png',
                'description' => 'Nasi Rames biasa bonus kerupuk',
                'status' =>  'aktif',
            ],
            [
                'category_id' => '1',
                'name' => 'Nasi Goreng',
                'price' => '8000',
                'image' => 'food7.png',
                'description' => 'Nasi Goreng original plus telor',
                'status' =>  'aktif',
            ],
            [
                'category_id' => '2',
                'name' => 'Es Teh',
                'price' => '4000',
                'image' => 'drink1.jpg',
                'description' => 'Es Teh manis kek kamu',
                'status' =>  'aktif',
            ],
            [
                'category_id' => '2',
                'name' => 'Es Jeruk',
                'price' => '5000',
                'image' => 'drink2.jpg',
                'description' => 'Es Jeruk bisa manis bisa kecut tergantung hoki',
                'status' =>  'aktif',
            ]
        ];

        foreach ($productData as $product) {
            $imagePath = public_path('images/products/' . $product['image']);

            if (File::exists($imagePath)) {
                Product::create([
                    'category_id' => $product['category_id'],
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'status' =>  $product['status'],
                ]);
            } else {
                echo "File gambar tidak ditemukan: {$product['image']}\n";
            }
        }
    }
}
