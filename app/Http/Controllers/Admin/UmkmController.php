<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use App\Models\Produk;

class UmkmController extends Controller
{
public function index()
{
    $umkm = Umkm::latest()->paginate(10);
    return view('admin.umkm.index', compact('umkm'));
}

    public function create()
    {
        return view('admin.umkm.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'deskripsi_usaha' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('umkm', 'public');
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function edit(Umkm $umkm)
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'deskripsi_usaha' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('umkm', 'public');
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm)
    {
        $umkm->delete();
        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus.');
    }

    public function publik(Request $request)
    {
        $produk = Produk::with(['umkm', 'kategori']);

        if ($request->search) {
            $produk->where('nama_produk', 'like', '%'.$request->search.'%');
        }

        if ($request->kategori) {
            $produk->whereHas('kategori', function ($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        $produk = $produk->get();

        return view('pages.katalog', compact('produk'));
    }

    public function detail($id)
    {
        $produk = \App\Models\Produk::with(['umkm', 'kategori'])->findOrFail($id);
        return view('pages.detail-produk', compact('produk'));
    }
}