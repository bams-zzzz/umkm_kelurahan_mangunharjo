<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama_produk' => 'Keripik Pisang Manis',
            'deskripsi' => 'Keripik pisang renyah dengan rasa manis original, dibuat dari pisang pilihan hasil panen lokal.',
            'harga' => 15000,
            'satuan' => 'per bungkus (250gr)',
            'status' => 'tersedia',
            'foto' => 'default.jpg',
            'is_featured' => true,
            'kategori_id' => 1,
            'umkm_id' => 1,
        ]);

        Produk::create([
            'nama_produk' => 'Tas Anyaman Pandan',
            'deskripsi' => 'Tas anyaman dari daun pandan kering, dikerjakan tangan oleh pengrajin desa.',
            'harga' => 85000,
            'satuan' => 'per buah',
            'status' => 'tersedia',
            'foto' => 'default.jpg',
            'is_featured' => true,
            'kategori_id' => 4,
            'umkm_id' => 2,
        ]);
    }
}