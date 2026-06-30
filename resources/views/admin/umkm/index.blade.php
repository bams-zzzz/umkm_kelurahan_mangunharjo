@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen p-8 font-sans">

    @if (session('success'))
        <div id="successAlert" class="max-w-6xl mx-auto bg-green-100 border-2 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-[3px_3px_0px_rgba(0,0,0,1)]" style="transition: opacity 0.5s ease;">
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

    <div class="max-w-6xl mx-auto border-[5px] border-blue-500 bg-white rounded-lg overflow-hidden shadow-2xl">

        <div class="flex items-center justify-between px-8 py-4 border-b-[5px] border-black bg-gray-100">
            <div class="w-1/4">
                <img src="{{ asset('images/Logo-kelurahan.png') }}" alt="Logo" class="h-14">
            </div>
            <div class="w-2/4 text-center">
                <h1 class="text-4xl font-extrabold text-black">Sampah UMKM</h1>
            </div>
            <div class="w-1/4 flex justify-end">
                <a href="{{ route('admin.umkm.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black font-extrabold py-2 px-6 rounded-xl border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] transition transform hover:-translate-y-1">
                    &larr; Kembali
                </a>
            </div>
        </div>

        <div class="p-8 bg-white">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="text-black font-extrabold text-lg border-b-4 border-black">
                        <th class="pb-4">Nama Produk</th>
                        <th class="pb-4">Pemilik</th>
                        <th class="pb-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($umkm as $item)
                    <tr class="border-b-2 border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-5 font-bold text-black">{{ $item->nama_usaha ?? $item->nama_produk }}</td>
                        <td class="py-5 font-bold text-black">{{ $item->nama_pemilik }}</td>
                        <td class="py-5 flex justify-center gap-3">
                            
                            <form action="{{ route('admin.umkm.restore', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-emerald-400 hover:bg-emerald-500 text-black font-extrabold py-2 px-6 rounded-xl border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] transition transform hover:-translate-y-1">
                                    Restore
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.umkm.forceDelete', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus permanen nih bos? Nggak bisa balik lagi lho!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-black font-extrabold py-2 px-6 rounded-xl border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] transition transform hover:-translate-y-1">
                                    Hapus Permanen
                                </button>
                            </form>
                            
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-10 text-center text-gray-500 font-bold text-lg">Tong sampah kosong bos. Aman!</td>
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