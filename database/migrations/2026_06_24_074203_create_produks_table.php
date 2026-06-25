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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->unsignedInteger('harga');
            $table->string('satuan');
            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
            $table->string('foto');
            $table->boolean('is_featured')->default(false);
            $table->foreignId('kategori_id')->constrained('kategori_produk')->cascadeOnDelete();
            $table->foreignId('umkm_id')->constrained('umkm')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
