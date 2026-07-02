<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Umkm;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['umkm', 'kategori'])->latest()->paginate(10);
        return view('admin.produk.index', compact('produk'));
    }
public function create()
{
    // Ambil data buat dropdown di form
    $umkm = Umkm::select('id', 'nama_usaha')->get();
    $kategori = KategoriProduk::select('id', 'nama_kategori')->get();
    
    return view('admin.produk.create', compact('umkm', 'kategori'));
}
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_produk'        => 'required|string|max:255',
        'deskripsi'          => 'nullable|string',
        'harga'              => 'required|numeric|min:0',
        'satuan'             => 'required|string',
        'status'             => 'required|in:ready,pre_order,out_of_stock,tersedia,habis',
        'umkm_id'            => 'required|exists:umkm,id',
        'kategori_id'        => 'required|exists:kategori_produk,id',
        'foto'               => 'nullable|image|max:2048',
        'is_featured'        => 'boolean',
        'alat_bahan'         => 'nullable|string',
        'langkah_pembuatan'  => 'nullable|string',
        'fungsi_kegunaan'    => 'nullable|string',
    ]);
    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('produk', 'public');
    }
    $validated['is_featured'] = $request->boolean('is_featured');
    $validated['deskripsi'] = $validated['deskripsi'] ?? '';
    Produk::create($validated);
    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambah!');
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
            'status' => 'required|in:tersedia,habis,ready,pre_order,out_of_stock',
            'foto' => 'nullable|image|max:2048',
            'hapus_foto' => 'nullable|boolean',
            'is_featured' => 'boolean',
            'kategori_id' => 'required|exists:kategori_produk,id',
            'umkm_id' => 'required|exists:umkm,id',
            'alat_bahan' => 'nullable|string',
            'langkah_pembuatan' => 'nullable|string',
            'fungsi_kegunaan' => 'nullable|string',
        ]);

        // Hapus field yang bukan kolom di tabel produk
        unset($validated['hapus_foto']);

        // Kalau user centang "Hapus foto ini"
        if ($request->boolean('hapus_foto') && $produk->foto && $produk->foto !== 'default.jpg') {
            Storage::disk('public')->delete($produk->foto);
            $validated['foto'] = null;
        }

        // Kalau user upload foto baru → hapus foto lama, simpan yang baru
        if ($request->hasFile('foto')) {
            if ($produk->foto && $produk->foto !== 'default.jpg') {
                Storage::disk('public')->delete($produk->foto);
            }
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
    public function trash()
{
    $produk = Produk::onlyTrashed()->latest()->paginate(10);
    return view('admin.produk.trash', compact('produk'));
}
public function restore($id)
{
    Produk::onlyTrashed()->findOrFail($id)->restore();
    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dikembalikan.');
}
public function forceDelete($id)
{
    $produk = Produk::onlyTrashed()->findOrFail($id);

    if ($produk->foto && $produk->foto !== 'default.jpg') {
        Storage::disk('public')->delete($produk->foto);
    }

    $produk->forceDelete();
    return redirect()->route('admin.produk.trash')->with('success', 'Produk dihapus permanen.');
}
}