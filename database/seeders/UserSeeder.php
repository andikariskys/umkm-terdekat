<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user Owner
        User::create([
            'name' => 'Anto Wijaya',
            'username' => 'owner',
            'email' => 'owner@umkmterdekat.com',
            'password' => bcrypt('password123'),
            'role' => 'owner',
            'business_name' => 'Warung Kopi Seduh',
            'business_address' => 'Jl. Raya No. 12, Serang',
            'business_phone' => '+62 812-0000-0000',
            'business_category' => 'F&B',
        ]);

        // Buat user Owner kedua
        User::create([
            'name' => 'Dewi Lestari',
            'username' => 'owner2',
            'email' => 'dewi@umkmterdekat.com',
            'password' => bcrypt('password123'),
            'role' => 'owner',
            'business_name' => 'Toko Kelontong Berkah',
            'business_address' => 'Jl. Pasar No. 45, Serang',
            'business_phone' => '+62 812-1111-1111',
            'business_category' => 'Retail',
        ]);

        // Buat user Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@umkmterdekat.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
    }
}
