@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-100 dark:text-white">Sampah UMKM</h1>
        <a href="{{ route('admin.umkm.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg">
            &larr; Kembali
        </a>
    </div>

@if (session('success'))
    <div id="successAlert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" style="transition: opacity 0.5s ease;">
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

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pemilik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dihapus Pada</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($umkm as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $item->produk->pluck('nama_produk')->join(', ') ?: '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $item->nama_produk }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $item->deleted_at->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4 text-sm flex gap-2">
                        <form action="{{ route('admin.umkm.restore', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-medium">
                                Restore
                            </button>
                        </form>
                        <form action="{{ route('admin.umkm.forceDelete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus permanen? Tidak bisa dikembalikan!')" class="bg-red-700 hover:bg-red-800 text-white px-3 py-1 rounded text-xs font-medium">
                                Hapus Permanen
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-4 text-sm text-center text-gray-500">Sampah kosong.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $umkm->links() }}</div>
</div>
@endsection