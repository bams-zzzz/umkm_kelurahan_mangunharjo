@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-100 dark:text-white">Tambah UMKM</h1>
        <a href="{{ route('admin.umkm.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
            &larr; Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data"
              class="p-6 space-y-6">
            @csrf

            <div>
                <label for="nama_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nama Produk
                </label>
                <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}"
                       class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label for="nama_pemilik" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nama Pemilik
                </label>
                <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ old('nama_pemilik') }}"
                       class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Alamat
                </label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                       class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label for="lokasi_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Lokasi Usaha
                </label>
                <input type="text" name="lokasi_usaha" id="lokasi_usaha" value="{{ old('lokasi_usaha') }}"
                       class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label for="no_wa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    No WhatsApp <span class="text-gray-400 dark:text-gray-500">(format: 628xxxx)</span>
                </label>
                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}"
                       class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label for="deskripsi_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Deskripsi Produk
                </label>
                <textarea name="deskripsi_produk" id="deskripsi_produk" rows="4"
                          class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y">{{ old('deskripsi_produk') }}</textarea>
            </div>

            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Kategori
                </label>
                <select name="kategori" id="kategori"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">Pilih Kategori</option>
                    <option value="camilan" {{ old('kategori') == 'camilan' ? 'selected' : '' }}>Camilan</option>
                    <option value="olahan_ikan" {{ old('kategori') == 'olahan_ikan' ? 'selected' : '' }}>Olahan Ikan</option>
                    <option value="olahan_telur" {{ old('kategori') == 'olahan_telur' ? 'selected' : '' }}>Olahan Telur</option>
                    <option value="minuman" {{ old('kategori') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="kebutuhan_harian" {{ old('kategori') == 'kebutuhan_harian' ? 'selected' : '' }}>Kebutuhan Harian</option>
                    <option value="jasa" {{ old('kategori') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                </select>
            </div>

            <div>
                <label for="bahan_dan_proses_produksi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Bahan & Proses Produksi
                </label>
                <textarea name="bahan_dan_proses_produksi" id="bahan_dan_proses_produksi" rows="6"
                          class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y">{{ old('bahan_dan_proses_produksi') }}</textarea>
            </div>

            <div>
                <label for="keunggulan_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Keunggulan Produk
                </label>
                <textarea name="keunggulan_produk" id="keunggulan_produk" rows="4"
                          class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y">{{ old('keunggulan_produk') }}</textarea>
            </div>

            <div>
                <label for="foto_profil" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Foto Profil
                </label>
                <input type="file" name="foto_profil" id="foto_profil"
                       class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 dark:file:bg-gray-700 dark:file:text-gray-300 file:cursor-pointer file:transition">
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition">
                    Simpan
                </button>
                <a href="{{ route('admin.umkm.index') }}"
                   class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection