<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    // Bebasin mass assignment untuk kolom yang dibutuhin
    protected $fillable = ['nama_produk', 'deskripsi', 'harga', 'satuan', 'status', 'kategori_id', 'umkm_id'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }
}