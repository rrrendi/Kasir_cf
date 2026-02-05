<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::firstOrCreate(
            ['email' => 'admin@kasir.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Buat Akun Kasir
        User::firstOrCreate(
            ['email' => 'kasir@kasir.com'],
            [
                'name' => 'Kasir 01',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ]
        );
        
        $this->command->info('User Admin & Kasir berhasil dibuat!');
    }
}