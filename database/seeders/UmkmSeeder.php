<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umkm;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        Umkm::create([
            'nama_usaha' => 'Toko Bu Siti',
            'nama_pemilik' => 'Siti Aminah',
            'alamat' => 'Desa Sukamaju RT 02/RW 05',
            'no_wa' => '6281234567890',
            'deskripsi_usaha' => 'Usaha keripik dan makanan ringan rumahan sejak 2018.',
            'foto_profil' => null,
        ]);

        Umkm::create([
            'nama_usaha' => 'Kerajinan Mawar',
            'nama_pemilik' => 'Mawar Sulistiowati',
            'alamat' => 'Desa Sukamaju RT 04/RW 02',
            'no_wa' => '6281298765432',
            'deskripsi_usaha' => 'Pengrajin anyaman pandan dan bambu khas desa.',
            'foto_profil' => null,
        ]);
    }
}