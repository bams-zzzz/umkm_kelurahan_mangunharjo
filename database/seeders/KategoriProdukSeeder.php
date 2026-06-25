<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriProduk;

class KategoriProdukSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Makanan & Minuman Olahan',
            'Hasil Pertanian/Perkebunan',
            'Hasil Perikanan',
            'Kerajinan Tangan',
            'Lainnya',
        ];

        foreach ($kategori as $nama) {
            KategoriProduk::create(['nama_kategori' => $nama]);
        }
    }
}