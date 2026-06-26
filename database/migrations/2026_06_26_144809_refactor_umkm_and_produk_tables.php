<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add columns to produk
        Schema::table('produk', function (Blueprint $table) {
            $table->text('alat_bahan')->nullable();
            $table->text('langkah_pembuatan')->nullable();
            $table->text('fungsi_kegunaan')->nullable();
        });

        // Update enum for status in produk to include umkm statuses
        DB::statement("ALTER TABLE produk MODIFY COLUMN status ENUM('ready', 'pre_order', 'out_of_stock', 'tersedia', 'habis') NOT NULL DEFAULT 'ready'");

        // 2. Migrate Data from UMKM to Produk
        $umkms = DB::table('umkm')->get();
        $mapKategori = [
            'camilan' => 'Camilan',
            'olahan_ikan' => 'Olahan Ikan',
            'olahan_telur' => 'Olahan Telur',
            'minuman' => 'Minuman',
            'kebutuhan_harian' => 'Kebutuhan Harian',
            'jasa' => 'Jasa'
        ];

        foreach ($umkms as $umkm) {
            $katName = $mapKategori[$umkm->kategori] ?? 'Lainnya';
            $kat = DB::table('kategori_produk')->where('nama_kategori', $katName)->first();
            $katId = $kat ? $kat->id : DB::table('kategori_produk')->insertGetId([
                'nama_kategori' => $katName, 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            DB::table('produk')->insert([
                'nama_produk' => $umkm->nama_usaha,
                'deskripsi' => $umkm->deskripsi_usaha ?? '',
                'harga' => 0,
                'satuan' => 'pcs',
                'status' => $umkm->status ?: 'ready',
                'foto' => $umkm->foto_profil ?? '',
                'is_featured' => 0,
                'kategori_id' => $katId,
                'umkm_id' => $umkm->id,
                'alat_bahan' => $umkm->alat_bahan,
                'langkah_pembuatan' => $umkm->langkah_pembuatan,
                'fungsi_kegunaan' => $umkm->fungsi_kegunaan,
                'created_at' => $umkm->created_at ?? date('Y-m-d H:i:s'),
                'updated_at' => $umkm->updated_at ?? date('Y-m-d H:i:s'),
            ]);

            DB::table('umkm')->where('id', $umkm->id)->update([
                'nama_usaha' => 'Usaha ' . $umkm->nama_pemilik,
                'deskripsi_usaha' => null, // clear description since it's now in produk
            ]);
        }

        // 3. Drop columns from umkm
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'status', 'alat_bahan', 'langkah_pembuatan', 'fungsi_kegunaan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->enum('kategori', ['camilan','olahan_ikan','olahan_telur','minuman','kebutuhan_harian','jasa'])->nullable();
            $table->enum('status', ['ready','pre_order','out_of_stock'])->default('ready');
            $table->text('alat_bahan')->nullable();
            $table->text('langkah_pembuatan')->nullable();
            $table->text('fungsi_kegunaan')->nullable();
        });

        // We won't reverse the data automatically as it's complex, but we drop the columns from produk
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn(['alat_bahan', 'langkah_pembuatan', 'fungsi_kegunaan']);
        });
        
        DB::statement("ALTER TABLE produk MODIFY COLUMN status ENUM('tersedia', 'habis') NOT NULL DEFAULT 'tersedia'");
    }
};
