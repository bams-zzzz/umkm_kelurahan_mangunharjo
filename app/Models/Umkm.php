<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umkm extends Model
{
    use SoftDeletes;

    protected $table = 'umkm';

protected $fillable = [
    'nama_produk', 'nama_pemilik', 'alamat', 'lokasi_usaha', 'no_wa',
    'deskripsi_produk', 'foto_profil', 'user_id', 'kategori',
    'bahan_dan_proses_produksi', 'keunggulan_produk',
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