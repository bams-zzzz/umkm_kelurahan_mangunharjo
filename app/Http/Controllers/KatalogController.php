<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
public function index()
{
    // Ambil semua produk beserta data UMKM dan Kategorinya
    $produk = Produk::with(['umkm', 'kategori'])->get();
    
    // Passing ke view FE lu
    return view('katalog.index', compact('produk'));
}

    public function show(Produk $produk)
    {
        $produk->load(['umkm', 'kategori']);

        return view('katalog.show', compact('produk'));
    }
}