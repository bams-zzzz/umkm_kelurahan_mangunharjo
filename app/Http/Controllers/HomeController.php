<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;

class HomeController extends Controller
{
public function index()
{
    $produk = Umkm::latest()->paginate(8);
    return view('pages.home', compact('produk'));
}
}
