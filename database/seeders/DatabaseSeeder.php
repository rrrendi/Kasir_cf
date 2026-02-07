<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'kasir'
        ]);

        // 2. Buat Kategori
        $makanan = Category::create(['name' => 'Makanan']);
        $minuman = Category::create(['name' => 'Minuman']);

        // 3. Buat Produk Dummy
        Product::create([
            'name' => 'Nasi Goreng',
            'category_id' => $makanan->id,
            'description' => 'Enak',
            'price' => 15000,
            'stock' => 50,
            'is_active' => true
        ]);
        
        Product::create([
            'name' => 'Es Teh',
            'category_id' => $minuman->id,
            'description' => 'Segar',
            'price' => 5000,
            'stock' => 100,
            'is_active' => true
        ]);
    }
}