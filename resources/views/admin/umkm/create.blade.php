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
                    Lokasi Usaha
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