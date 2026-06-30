@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen p-8 font-sans">

    <div class="max-w-4xl mx-auto border-[5px] border-blue-500 bg-white rounded-lg overflow-hidden shadow-2xl">

        <div class="flex items-center justify-between px-8 py-5 border-b-[5px] border-black bg-gray-100">
            <h1 class="text-3xl font-extrabold text-black">Tambah UMKM</h1>
            <a href="{{ route('admin.umkm.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black font-extrabold py-2 px-6 rounded-xl border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] transition transform hover:-translate-y-1">
                &larr; Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-200 border-b-[5px] border-black px-8 py-5">
                <p class="font-extrabold text-red-900 mb-2">Waduh, ada yang salah nih bos:</p>
                <ul class="list-disc list-inside font-bold text-red-800">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6 bg-white">
            @csrf

            <div>
                <label for="nama_produk" class="block font-extrabold text-black mb-2 text-lg">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}"
                       class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)]">
            </div>

            <div>
                <label for="nama_pemilik" class="block font-extrabold text-black mb-2 text-lg">Nama Pemilik</label>
                <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ old('nama_pemilik') }}"
                       class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)]">
            </div>

            <div>
                <label for="alamat" class="block font-extrabold text-black mb-2 text-lg">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                       class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)]">
            </div>

            <div>
                <label for="lokasi_usaha" class="block font-extrabold text-black mb-2 text-lg">Lokasi Usaha</label>
                <input type="text" name="lokasi_usaha" id="lokasi_usaha" value="{{ old('lokasi_usaha') }}"
                       class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)]">
            </div>

            <div>
                <label for="no_wa" class="block font-extrabold text-black mb-2 text-lg">
                    No WhatsApp <span class="text-sm text-gray-500 font-normal">(format: 628xxxx)</span>
                </label>
                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}"
                       class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)]">
            </div>

            <div>
                <label for="deskripsi_produk" class="block font-extrabold text-black mb-2 text-lg">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" id="deskripsi_produk" rows="4"
                          class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)] resize-y">{{ old('deskripsi_produk') }}</textarea>
            </div>

            <div>
                <label for="kategori" class="block font-extrabold text-black mb-2 text-lg">Kategori</label>
                <select name="kategori" id="kategori"
                        class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                    <option value="" class="font-bold">Pilih Kategori</option>
                    <option value="camilan" {{ old('kategori') == 'camilan' ? 'selected' : '' }}>Camilan</option>
                    <option value="olahan_ikan" {{ old('kategori') == 'olahan_ikan' ? 'selected' : '' }}>Olahan Ikan</option>
                    <option value="olahan_telur" {{ old('kategori') == 'olahan_telur' ? 'selected' : '' }}>Olahan Telur</option>
                    <option value="minuman" {{ old('kategori') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="kebutuhan_harian" {{ old('kategori') == 'kebutuhan_harian' ? 'selected' : '' }}>Kebutuhan Harian</option>
                    <option value="jasa" {{ old('kategori') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                </select>
            </div>

            <div>
                <label for="bahan_dan_proses_produksi" class="block font-extrabold text-black mb-2 text-lg">Bahan & Proses Produksi</label>
                <textarea name="bahan_dan_proses_produksi" id="bahan_dan_proses_produksi" rows="6"
                          class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)] resize-y">{{ old('bahan_dan_proses_produksi') }}</textarea>
            </div>

            <div>
                <label for="keunggulan_produk" class="block font-extrabold text-black mb-2 text-lg">Keunggulan Produk</label>
                <textarea name="keunggulan_produk" id="keunggulan_produk" rows="4"
                          class="w-full rounded-xl border-2 border-black bg-white text-black px-4 py-3 font-bold focus:outline-none focus:bg-yellow-50 transition shadow-[4px_4px_0px_rgba(0,0,0,1)] resize-y">{{ old('keunggulan_produk') }}</textarea>
            </div>

            <div>
                <label for="foto_profil" class="block font-extrabold text-black mb-2 text-lg">Foto Profil</label>
                <input type="file" name="foto_profil" id="foto_profil"
                       class="w-full text-black font-bold file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-2 file:border-black file:text-sm file:font-extrabold file:bg-blue-200 file:text-black hover:file:bg-blue-300 file:shadow-[3px_3px_0px_rgba(0,0,0,1)] file:cursor-pointer transition">
            </div>

            <div class="flex items-center gap-5 pt-8 mt-4 border-t-[4px] border-dashed border-gray-300">
                <button type="submit"
                        class="bg-emerald-400 hover:bg-emerald-500 text-black font-extrabold py-3 px-8 rounded-xl border-2 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] transition transform hover:-translate-y-1">
                    Simpan Data
                </button>
                <a href="{{ route('admin.umkm.index') }}"
                   class="text-gray-500 hover:text-black font-bold underline transition">
                    Batal Aja
                </a>
            </div>
        </form>

    </div>
</div>
@endsection