<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

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
            'nama_usaha' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'deskripsi_usaha' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048',
            'kategori' => 'nullable|in:plastik,kardus,ban_bekas,kaca',
            'status' => 'required|in:ready,pre_order,out_of_stock',
            'alat_bahan' => 'nullable|string',
            'langkah_pembuatan' => 'nullable|string',
            'fungsi_kegunaan' => 'nullable|string',
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
            'nama_usaha' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'deskripsi_usaha' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048',
            'kategori' => 'nullable|in:plastik,kardus,ban_bekas,kaca',
            'status' => 'required|in:ready,pre_order,out_of_stock',
            'alat_bahan' => 'nullable|string',
            'langkah_pembuatan' => 'nullable|string',
            'fungsi_kegunaan' => 'nullable|string',
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
        $query = Umkm::query();

        if ($request->filled('search')) {
            $query->where('nama_usaha', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi_usaha', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $produk = $query->latest()->paginate(12);

        return view('publik.produk', compact('produk'));
    }

    public function detail($id)
    {
        $produk = Umkm::findOrFail($id);
        return view('publik.detail', compact('produk'));
    }
}