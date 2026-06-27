<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class HomeController extends Controller
{
public function index()
{
    $produk = Produk::with(['umkm', 'kategori'])->latest()->get();
    return view('pages.home', compact('produk'));
}
}