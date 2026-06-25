<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Umkm;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['umkm', 'kategori'])->latest()->paginate(10);
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        $umkm = Umkm::all();
        $kategori = KategoriProduk::all();
        return view('admin.produk.create', compact('umkm', 'kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'status' => 'required|in:tersedia,habis',
            'foto' => 'required|image|max:2048',
            'is_featured' => 'boolean',
            'kategori_id' => 'required|exists:kategori_produk,id',
            'umkm_id' => 'required|exists:umkm,id',
        ]);

        $validated['foto'] = $request->file('foto')->store('produk', 'public');
        $validated['is_featured'] = $request->boolean('is_featured');

        Produk::create($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $umkm = Umkm::all();
        $kategori = KategoriProduk::all();
        return view('admin.produk.edit', compact('produk', 'umkm', 'kategori'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'status' => 'required|in:tersedia,habis',
            'foto' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'kategori_id' => 'required|exists:kategori_produk,id',
            'umkm_id' => 'required|exists:umkm,id',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $produk->update($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}