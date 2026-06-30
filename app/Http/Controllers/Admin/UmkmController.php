<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    'lokasi_usaha' => 'nullable|string|max:255',
    'no_wa' => 'required|string|max:20',
    'deskripsi_produk' => 'nullable|string',
    'foto_profil' => 'nullable|image|max:2048',
    'kategori' => 'nullable|in:camilan,olahan_ikan,olahan_telur,minuman,kebutuhan_harian,jasa',
    'bahan_dan_proses_produksi' => 'nullable|string',
    'keunggulan_produk' => 'nullable|string',
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
    'kategori' => 'nullable|in:camilan,olahan_ikan,olahan_telur,minuman,kebutuhan_harian,jasa',
    'bahan_dan_proses_produksi' => 'nullable|string',
    'keunggulan_produk' => 'nullable|string',
]);
if ($request->hasFile('foto_profil')) {
    // Hapus foto lama kalau ada, sebelum upload yang baru
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
        Umkm::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.umkm.trash')->with('success', 'UMKM dihapus permanen.');
    }

    public function publik(Request $request)
    {
        $produk = Umkm::query();

        if ($request->search) {
            $produk->where('nama_produk', 'like', '%'.$request->search.'%');
        }

        if ($request->kategori) {
            $produk->where('kategori', $request->kategori);
        }

        $produk = $produk->get();

        return view('pages.katalog', compact('produk'));
    }

    public function detail($id)
    {
        $produk = Umkm::findOrFail($id);
        return view('pages.detail-produk', compact('produk'));
    }
}