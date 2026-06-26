<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    
    public function produk()
    {
        return $this->hasMany(Produk::class, 'umkm_id');
    }
}