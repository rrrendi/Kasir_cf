<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User
        User::create(['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('admin123'), 'role' => 'admin']);
        User::create(['name' => 'Kasir', 'email' => 'kasir@gmail.com', 'password' => bcrypt('kasir123'), 'role' => 'kasir']);

        // 2. Kategori
        $cat1 = Category::create(['name' => 'Makanan']);
        $cat2 = Category::create(['name' => 'Minuman']);

        // 3. Produk
        Product::create(['name' => 'Nasi Goreng', 'category_id' => $cat1->id, 'price' => 15000, 'stock' => 50, 'is_active' => true]);
        Product::create(['name' => 'Es Teh', 'category_id' => $cat2->id, 'price' => 5000, 'stock' => 100, 'is_active' => true]);
    }
}