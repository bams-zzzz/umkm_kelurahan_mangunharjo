<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['umkm', 'kategori'])->where('status', 'tersedia');

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%'.$request->search.'%');
        }

        $produk = $query->latest()->paginate(12);
        $kategori = KategoriProduk::all();

        return view('katalog.index', compact('produk', 'kategori'));
    }

    public function show(Produk $produk)
    {
        $produk->load(['umkm', 'kategori']);

        return view('katalog.show', compact('produk'));
    }
}