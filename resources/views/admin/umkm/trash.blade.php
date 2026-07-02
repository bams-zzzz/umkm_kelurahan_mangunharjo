@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen p-8 font-sans">

    @if (session('success'))
        <div id="successAlert" class="max-w-6xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6" style="transition: opacity 0.5s ease;">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function () {
                const alertBox = document.getElementById('successAlert');
                if (alertBox) {
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 500);
                }
            }, 10000);
        </script>
    @endif

    <div class="max-w-6xl mx-auto border border-gray-300 bg-white rounded-xl overflow-hidden shadow-sm">

        <div class="flex items-center justify-between gap-4 px-8 py-5 border-b border-gray-300 bg-gray-50">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/Logo-kelurahan.png') }}" alt="Logo" class="h-12">
                <h1 class="text-3xl font-bold text-black">Sampah UMKM</h1>
            </div>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-1 text-gray-600 font-medium hover:text-black transition">
                    Admin Desa
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" x-cloak class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 px-8 pt-6">
            <a href="{{ route('admin.umkm.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-semibold py-2 px-6 rounded-full shadow-sm transition">
                &larr; Kembali
            </a>
        </div>

        <div class="p-8 bg-white" style="overflow-x: auto; width: 100%;">
            <table class="w-full text-center border-collapse min-w-[700px]">
                <thead>
                    <tr class="text-black font-bold text-base border-b border-gray-300">
                        <th class="pb-4">Nama Produk</th>
                        <th class="pb-4">Pemilik</th>
                        <th class="pb-4">No WA</th>
                        <th class="pb-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($umkm as $item)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-5 px-2 font-medium text-black">{{ $item->produk->pluck('nama_produk')->join(', ') ?: '-' }}</td>
                        <td class="py-5 px-2 font-medium text-black"></td>
                        <td class="py-5 px-2 font-medium text-black"></td>
                        <td class="py-5 px-2 flex justify-center gap-3">

                            <form action="{{ route('admin.umkm.restore', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-emerald-400 hover:bg-emerald-500 text-black font-semibold py-2 px-4 rounded-full shadow-sm transition">
                                    Restore
                                </button>
                            </form>

                            <form action="{{ route('admin.umkm.forceDelete', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus permanen? Data tidak bisa dikembalikan lagi!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-400 hover:bg-red-500 text-black font-semibold py-2 px-4 rounded-full shadow-sm transition">
                                    Hapus Permanen
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-10 text-center text-gray-500 font-medium text-lg">Sampah kosong.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($umkm->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $umkm->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection