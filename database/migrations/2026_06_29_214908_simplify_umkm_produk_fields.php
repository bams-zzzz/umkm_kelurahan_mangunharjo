<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom baru (tanpa 'after' yang bikin error)
        Schema::table('umkm', function (Blueprint $table) {
            if (!Schema::hasColumn('umkm', 'bahan_dan_proses_produksi')) {
                $table->text('bahan_dan_proses_produksi')->nullable();
            }
            if (!Schema::hasColumn('umkm', 'lokasi_usaha')) {
                $table->string('lokasi_usaha')->nullable();
            }
        });

        // 2. Gabungkan isi HANYA JIKA kolom aslinya masih ada
        if (Schema::hasColumn('umkm', 'alat_bahan')) {
            $rows = DB::table('umkm')->get();
            foreach ($rows as $row) {
                // Pake fallback ?? '' biar aman kalau datanya kosong
                $alat = $row->alat_bahan ?? '';
                $langkah = $row->langkah_pembuatan ?? '';

                $gabungan = trim(
                    ($alat ? "Bahan & Alat:\n" . $alat : '') .
                    ($langkah ? "\n\nProses Produksi:\n" . $langkah : '')
                );

                DB::table('umkm')->where('id', $row->id)->update([
                    'bahan_dan_proses_produksi' => $gabungan ?: null,
                ]);
            }
        }

        // 3. Rename fungsi_kegunaan -> keunggulan_produk (Cek dulu biar gak crash)
        if (Schema::hasColumn('umkm', 'fungsi_kegunaan') && !Schema::hasColumn('umkm', 'keunggulan_produk')) {
            DB::statement('ALTER TABLE umkm CHANGE fungsi_kegunaan keunggulan_produk TEXT NULL');
        }

        // 4. Hapus kolom dengan aman (Cek satu-satu yang mau dihapus)
        Schema::table('umkm', function (Blueprint $table) {
            $buang = [];
            if (Schema::hasColumn('umkm', 'status')) $buang[] = 'status';
            if (Schema::hasColumn('umkm', 'alat_bahan')) $buang[] = 'alat_bahan';
            if (Schema::hasColumn('umkm', 'langkah_pembuatan')) $buang[] = 'langkah_pembuatan';
            
            if (count($buang) > 0) {
                $table->dropColumn($buang);
            }
        });
    }

    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            if (!Schema::hasColumn('umkm', 'status')) $table->enum('status', ['ready', 'pre_order', 'out_of_stock'])->default('ready');
            if (!Schema::hasColumn('umkm', 'alat_bahan')) $table->text('alat_bahan')->nullable();
            if (!Schema::hasColumn('umkm', 'langkah_pembuatan')) $table->text('langkah_pembuatan')->nullable();
        });

        if (Schema::hasColumn('umkm', 'keunggulan_produk') && !Schema::hasColumn('umkm', 'fungsi_kegunaan')) {
            DB::statement('ALTER TABLE umkm CHANGE keunggulan_produk fungsi_kegunaan TEXT NULL');
        }

        Schema::table('umkm', function (Blueprint $table) {
            $buang = [];
            if (Schema::hasColumn('umkm', 'bahan_dan_proses_produksi')) $buang[] = 'bahan_dan_proses_produksi';
            if (Schema::hasColumn('umkm', 'lokasi_usaha')) $buang[] = 'lokasi_usaha';
            
            if (count($buang) > 0) {
                $table->dropColumn($buang);
            }
        });
    }
};