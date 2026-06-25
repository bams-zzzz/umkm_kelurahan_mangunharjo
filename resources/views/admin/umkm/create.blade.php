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
                <label for="nama_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nama Usaha
                </label>
                <input type="text" name="nama_usaha" id="nama_usaha" value="{{ old('nama_usaha') }}"
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
                <label for="no_wa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    No WhatsApp <span class="text-gray-400 dark:text-gray-500">(format: 628xxxx)</span>
                </label>
                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}"
                       class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label for="deskripsi_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Deskripsi Usaha
                </label>
                <textarea name="deskripsi_usaha" id="deskripsi_usaha" rows="4"
                          class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y">{{ old('deskripsi_usaha') }}</textarea>
            </div>

            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Kategori
                </label>
                <select name="kategori" id="kategori"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="">Pilih Kategori</option>
                    <option value="plastik" {{ old('kategori') == 'plastik' ? 'selected' : '' }}>Plastik</option>
                    <option value="kardus" {{ old('kategori') == 'kardus' ? 'selected' : '' }}>Kardus</option>
                    <option value="ban_bekas" {{ old('kategori') == 'ban_bekas' ? 'selected' : '' }}>Ban Bekas</option>
                    <option value="kaca" {{ old('kategori') == 'kaca' ? 'selected' : '' }}>Kaca</option>
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Status
                </label>
                <select name="status" id="status"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    <option value="ready" {{ old('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                    <option value="pre_order" {{ old('status') == 'pre_order' ? 'selected' : '' }}>Pre-Order</option>
                    <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>

            <div>
                <label for="alat_bahan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Alat & Bahan
                </label>
                <textarea name="alat_bahan" id="alat_bahan" rows="4"
                          class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y">{{ old('alat_bahan') }}</textarea>
            </div>

            <div>
                <label for="langkah_pembuatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Langkah Pembuatan
                </label>
                <textarea name="langkah_pembuatan" id="langkah_pembuatan" rows="4"
                          class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y">{{ old('langkah_pembuatan') }}</textarea>
            </div>

            <div>
                <label for="fungsi_kegunaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Fungsi & Kegunaan
                </label>
                <textarea name="fungsi_kegunaan" id="fungsi_kegunaan" rows="4"
                          class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y">{{ old('fungsi_kegunaan') }}</textarea>
            </div>

            <div>
                <label for="foto_profil" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Foto Profil
                </label>
                <input type="file" name="foto_profil" id="foto_profil"
                       class="w-full text-sm text-gray-500 dark:text-gray-400
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:text-sm file:font-medium
                              file:bg-blue-50 file:text-blue-700
                              dark:file:bg-gray-700 dark:file:text-gray-300
                              hover:file:bg-blue-100 dark:hover:file:bg-gray-600
                              file:cursor-pointer file:transition">
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