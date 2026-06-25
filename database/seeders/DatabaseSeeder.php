<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin@umkmdesa.test',
            'password' => bcrypt('password123'),
        ]);

        $this->call([
            KategoriProdukSeeder::class,
            UmkmSeeder::class,
            ProdukSeeder::class,
        ]);
    }
}