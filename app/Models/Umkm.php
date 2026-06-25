<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';

    protected $fillable = [
        'nama_usaha',
        'nama_pemilik',
        'alamat',
        'no_wa',
        'deskripsi_usaha',
        'foto_profil',
        'user_id',
        'kategori',
        'status',
        'alat_bahan',
        'langkah_pembuatan',
        'fungsi_kegunaan',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'umkm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}