<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->enum('kategori', ['plastik', 'kardus', 'ban_bekas', 'kaca'])->nullable();
            $table->enum('status', ['ready', 'pre_order', 'out_of_stock'])->default('ready');
            $table->text('alat_bahan')->nullable();
            $table->text('langkah_pembuatan')->nullable();
            $table->text('fungsi_kegunaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'status', 'alat_bahan', 'langkah_pembuatan', 'fungsi_kegunaan']);
        });
    }
};
