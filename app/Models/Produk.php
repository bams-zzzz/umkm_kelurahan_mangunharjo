<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk', 'deskripsi', 'harga', 'satuan', 'status',
        'foto', 'is_featured', 'kategori_id', 'umkm_id',
        'alat_bahan', 'langkah_pembuatan', 'fungsi_kegunaan',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }
}