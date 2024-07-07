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

            // tenant_id = '1' => Kantin Soto Banyuwangi
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Nasi Soto',
                'price' => '7000',
                'image' => 'food1.png',
                'description' => 'Nasi soto terdiri dari nasi, ayam, dan kuah soto kental',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 312,
                    'karbohidrat' => 19.55,
                    'protein' => 24.01,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Nasi Pecel',
                'price' => '7000',
                'image' => 'food4.png',
                'description' => 'Nasi pecel. Makanan nasi panas dengan sayur segar dan bumbu pecel khas madiun',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 230,
                    'karbohidrat' => 6.58,
                    'protein' => 31.74,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Rujak Soto',
                'price' => '8000',
                'image' => 'rujaksoto.png',
                'description' => 'Rujak soto khas Banyuwangi hadir dengan perpaduan rujak sayur yang segar dan kuah soto yang gurih.',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 405,
                    'karbohidrat' => 16.21,
                    'protein' => 28.43,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Lalapan Sisit',
                'price' => '9000',
                'image' => 'lalapansisit.png',
                'description' => 'Nasi Lalapan yang terdiri dari berbagai macam sayuran segar, sambal, + Ikan asin',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 323,
                    'karbohidrat' => 44.7,
                    'protein' => 2.66,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Mie Rebus Telur',
                'price' => '7500',
                'image' => 'mierebus.png',
                'description' => 'Mie rebus kenyal yang dimasak dengan bumbu gurih, ditambah dengan nikmatnya telur ceplok',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 574,
                    'karbohidrat' => 15.3,
                    'protein' => 57.6,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Mie Goreng Telur',
                'price' => '6500',
                'image' => 'miegoreng.png',
                'description' => 'Mie goreng kenyal yang dimasak dengan bumbu gurih, ditambah dengan nikmatnya telur ceplok',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 380,
                    'karbohidrat' => 54,
                    'protein' => 8,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '1',
                'name' => 'Nasi Lodeh Telur',
                'price' => '8000',
                'image' => 'lodehtelur.png',
                'description' => 'Nasi, lodeh (sayur santan gurih) dan telur dimask dengan bumbu kuning',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 350,
                    'karbohidrat' => 27.7,
                    'protein' => 8.94,
                ],
            ],
            [
                'category_id' => '2',
                'tenant_id' => '1',
                'name' => 'Es Teh',
                'price' => '3000',
                'image' => 'drink1.jpg',
                'description' => 'Es teh ukuran regular',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 90,
                    'lemak' => 0.1,
                    'gula' => 22.83,
                ],
            ],
            [
                'category_id' => '2',
                'tenant_id' => '1',
                'name' => 'Es Jeruk',
                'price' => '4000',
                'image' => 'drink2.jpg',
                'description' => 'Es Jeruk Peras ukuran reguler',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 112,
                    'lemak' => 0.5,
                    'gula' => 22.83,
                ],
            ],
            [
                'category_id' => '2',
                'tenant_id' => '1',
                'name' => 'Kopi Panas',
                'price' => '4000',
                'image' => 'kopi.png',
                'description' => 'Kopi Arabica panas. Bisa pilih varian : Kopi Hitam, Kopi Susu, Cappucino. Tulis nama varian di catatan tambahan pesanan untuk memilih varian',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 150,
                    'lemak' => 4,
                    'gula' => 10,
                ],
            ],

            // tenant_id = '2' => Kantin Soto Banyuwangi
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Pecel Madiun',
                'price' => '7000',
                'image' => 'pecelmadiun.png',
                'description' => 'Nasi Pecel Madiun + tempe',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 193,
                    'karbohidrat' => 9.39,
                    'protein' => 18.54,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Pecel Madiun Telur',
                'price' => '8000',
                'image' => 'pecelmadiuntelur.png',
                'description' => 'Nasi Pecel Madiun + Tempe + Telur',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 426,
                    'karbohidrat' => 37,
                    'protein' => 25.03,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Nasi Telur Srundeng',
                'price' => '8000',
                'image' => 'srundengtelur.png',
                'description' => 'Nasi telur dengan serundeng (perutan kelapa yang dimasak sampai kecoklatan)',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 205,
                    'karbohidrat' => 45.02,
                    'protein' => 12.03,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Nasi Ayam Geprek',
                'price' => '8000',
                'image' => 'food2.png',
                'description' => 'Nasi dengan ayam geprek reguler dan sambal bawang',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 321,
                    'karbohidrat' => 20,
                    'protein' => 37,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Tahu Kocek',
                'price' => '5000',
                'image' => 'tahukocek.png',
                'description' => 'Tahu aci yang digoreng dan di ulek dengan sambal bawang khas Jember',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 76,
                    'karbohidrat' => 3,
                    'protein' => 4.9,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Tahu Tek Telur',
                'price' => '8000',
                'image' => 'food3.png',
                'description' => 'Tahu yang digoreng dengan baluran telur ditambah lontong dan bumbu kacang khas surabaya',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 256,
                    'karbohidrat' => 22.75,
                    'protein' => 17.92,
                ],
            ],
            [
                'category_id' => '1',
                'tenant_id' => '2',
                'name' => 'Tahu Crispy',
                'price' => '8000',
                'image' => 'tahucrispy.png',
                'description' => 'Tahu crispy dengan berbagai macam bumbu tabur. Bisa pilih bumbu : Keju, Barbeque, Jagung Manis, Ayam Panggang, Jagung Bakar, Balado, Pedas. Tulis nama varian bumbu di catatan tambahan pesanan untuk memilih varian rasa bumbu',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 118,
                    'karbohidrat' => 10,
                    'protein' => 4.79,
                ],
            ],
            [
                'category_id' => '2',
                'tenant_id' => '2',
                'name' => 'Lemon Lime',
                'price' => '4000',
                'image' => 'lemonlime.png',
                'description' => 'Minuman es lemon dengan sparkling water dan biji selasih',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 70,
                    'lemak' => 0.1,
                    'gula' => 0.74,
                ],
            ],
            [
                'category_id' => '2',
                'tenant_id' => '2',
                'name' => 'Es Teh',
                'price' => '4000',
                'image' => 'esteh.png',
                'description' => 'Es Teh Regular',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 90,
                    'lemak' => 0.1,
                    'gula' => 22.83,
                ],
            ],
            [
                'category_id' => '2',
                'tenant_id' => '2',
                'name' => 'Es Lumut Susu',
                'price' => '3000',
                'image' => 'lumutsusu.png',
                'description' => 'Minuman es jelly lumut dengan creamer dan susu kental manis ',
                'status' => 'aktif',
                'nutritions' => [
                    'kalori' => 160,
                    'lemak' => 0.1,
                    'gula' => 57,
                ],
            ],
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
