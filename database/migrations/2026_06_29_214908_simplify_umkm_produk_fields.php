<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom baru
        Schema::table('umkm', function (Blueprint $table) {
            $table->text('bahan_dan_proses_produksi')->nullable()->after('alat_bahan');
            $table->string('lokasi_usaha')->nullable()->after('alamat');
        });

        // 2. Gabungkan isi alat_bahan + langkah_pembuatan ke kolom baru
        $rows = DB::table('umkm')->get();
        foreach ($rows as $row) {
            $gabungan = trim(
                ($row->alat_bahan ? "Bahan & Alat:\n" . $row->alat_bahan : '') .
                ($row->langkah_pembuatan ? "\n\nProses Produksi:\n" . $row->langkah_pembuatan : '')
            );

            DB::table('umkm')->where('id', $row->id)->update([
                'bahan_dan_proses_produksi' => $gabungan ?: null,
            ]);
        }

        // 3. Rename fungsi_kegunaan -> keunggulan_produk (raw SQL, gak butuh doctrine/dbal)
        DB::statement('ALTER TABLE umkm CHANGE fungsi_kegunaan keunggulan_produk TEXT NULL');

        // 4. Hapus kolom yang udah gak dipakai
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['status', 'alat_bahan', 'langkah_pembuatan']);
        });
    }

    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->enum('status', ['ready', 'pre_order', 'out_of_stock'])->default('ready');
            $table->text('alat_bahan')->nullable();
            $table->text('langkah_pembuatan')->nullable();
        });

        DB::statement('ALTER TABLE umkm CHANGE keunggulan_produk fungsi_kegunaan TEXT NULL');

        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['bahan_dan_proses_produksi', 'lokasi_usaha']);
        });
    }
};