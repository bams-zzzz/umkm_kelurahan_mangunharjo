<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;

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