<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Buat User Kasir
        User::firstOrCreate(
            ['email' => 'kasir@gmail.com'],
            [
                'name' => 'Kasir 01',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ]
        );
        
        $this->command->info('User Admin & Kasir BERHASIL dibuat!');
    }
}