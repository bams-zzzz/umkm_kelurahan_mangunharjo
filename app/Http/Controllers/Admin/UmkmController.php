<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
public function index()
{
    $produk = Produk::with('umkm')->latest()->paginate(10);
    return view('admin.umkm.index', compact('produk'));
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
            'lokasi_usaha' => 'nullable|string|max:255',
            'no_wa' => 'required|string|max:20',
            'deskripsi_produk' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048',
            'bahan_dan_proses_produksi' => 'nullable|string',
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
            'lokasi_usaha' => 'nullable|string|max:255',
            'no_wa' => 'required|string|max:20',
            'deskripsi_produk' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048',
            'bahan_dan_proses_produksi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_profil')) {
            if ($umkm->foto_profil && Storage::disk('public')->exists($umkm->foto_profil)) {
                Storage::disk('public')->delete($umkm->foto_profil);
            }
            $validated['foto_profil'] = $request->file('foto_profil')->store('umkm', 'public');
        } elseif ($request->boolean('hapus_foto') && $umkm->foto_profil) {
            Storage::disk('public')->delete($umkm->foto_profil);
            $validated['foto_profil'] = null;
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm)
    {
        $umkm->delete();
        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus.');
    }

    public function trash()
    {
        $umkm = Umkm::onlyTrashed()->latest()->paginate(10);
        return view('admin.umkm.trash', compact('umkm'));
    }

    public function restore($id)
    {
        Umkm::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $umkm = Umkm::onlyTrashed()->findOrFail($id);

        if ($umkm->foto_profil && Storage::disk('public')->exists($umkm->foto_profil)) {
            Storage::disk('public')->delete($umkm->foto_profil);
        }

        $umkm->forceDelete();
        return redirect()->route('admin.umkm.trash')->with('success', 'UMKM dihapus permanen.');
    }

    public function publik(Request $request)
    {
        $produk = Produk::with(['umkm', 'kategori']);

        if ($request->search) {
            $search = $request->search;
            $produk->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function($kQuery) use ($search) {
                      $kQuery->where('nama_kategori', 'like', "%{$search}%");
                  })
                  ->orWhereHas('umkm', function($uQuery) use ($search) {
                      $uQuery->where('nama_pemilik', 'like', "%{$search}%")
                             ->orWhere('alamat', 'like', "%{$search}%")
                             ->orWhere('lokasi_usaha', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->kategori) {
            $produk->whereHas('kategori', function ($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        $produk = $produk->latest()->get();

        return view('pages.katalog', compact('produk'));
    }

    public function detail($id)
    {
        $produk = Produk::with(['umkm', 'kategori'])->findOrFail($id);
        return view('pages.detail-produk', compact('produk'));
    }
}