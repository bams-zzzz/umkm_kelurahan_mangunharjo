<?php

namespace App\Http\Controllers;

use App\Models\Umkm;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Umkm::latest()->get();
        return view('pages.home', compact('produk'));
    }
}