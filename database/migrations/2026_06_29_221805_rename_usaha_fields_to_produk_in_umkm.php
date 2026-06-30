<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE umkm CHANGE nama_usaha nama_produk VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE umkm CHANGE deskripsi_usaha deskripsi_produk TEXT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE umkm CHANGE nama_produk nama_usaha VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE umkm CHANGE deskripsi_produk deskripsi_usaha TEXT NULL');
    }
};