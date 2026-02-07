<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat user jika belum ada
        if (User::where('email', 'admin@example.com')->doesntExist()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]);
        }

        if (User::where('email', 'kasir@example.com')->doesntExist()) {
            User::create([
                'name' => 'Kasir Toko',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('kasir123'),
                'role' => 'kasir',
            ]);
        }

        // 2. Buat kategori jika belum ada
        $categories = [
            ['name' => 'Makanan', 'description' => 'Produk makanan', 'slug' => 'makanan'],
            ['name' => 'Minuman', 'description' => 'Produk minuman', 'slug' => 'minuman'],
            ['name' => 'Snack', 'description' => 'Camilan ringan', 'slug' => 'snack'],
            ['name' => 'ATK', 'description' => 'Alat Tulis Kantor', 'slug' => 'atk'],
            ['name' => 'Elektronik', 'description' => 'Barang elektronik kecil', 'slug' => 'elektronik'],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        // 3. Buat produk contoh
        $makananId = Category::where('slug', 'makanan')->first()->id;
        $minumanId = Category::where('slug', 'minuman')->first()->id;
        $snackId = Category::where('slug', 'snack')->first()->id;
        $atkId = Category::where('slug', 'atk')->first()->id;
        $elektronikId = Category::where('slug', 'elektronik')->first()->id;

        $products = [
            [
                'name' => 'Indomie Goreng',
                'description' => 'Mie instan rasa goreng',
                'price' => 3500,
                'stock' => 100,
                'category_id' => $makananId,
                'is_active' => true
            ],
            [
                'name' => 'Aqua 600ml',
                'description' => 'Air mineral kemasan',
                'price' => 3000,
                'stock' => 50,
                'category_id' => $minumanId,
                'is_active' => true
            ],
            [
                'name' => 'Chitato',
                'description' => 'Keripik kentang',
                'price' => 12000,
                'stock' => 30,
                'category_id' => $snackId,
                'is_active' => true
            ],
            [
                'name' => 'Pulpen Pilot',
                'description' => 'Pulpen tinta biru',
                'price' => 5000,
                'stock' => 40,
                'category_id' => $atkId,
                'is_active' => true
            ],
            [
                'name' => 'Baterai AA',
                'description' => 'Baterai alkaline',
                'price' => 15000,
                'stock' => 25,
                'category_id' => $elektronikId,
                'is_active' => true
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate(
                ['name' => $productData['name']],
                $productData
            );
        }

        $this->command->info('Seeder berhasil dijalankan!');
        $this->command->info('Admin: admin@example.com / password123');
        $this->command->info('Kasir: kasir@example.com / password123');
    }
}