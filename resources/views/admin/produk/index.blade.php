@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-100 dark:text-white">Kelola UMKM</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.umkm.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
                + Tambah UMKM
            </a>
            <a href="{{ route('admin.umkm.trash') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg">
                🗑 Sampah
            </a>
        </div>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Usaha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pemilik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No WA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($umkm as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $item->nama_usaha }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $item->nama_pemilik }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $item->no_wa }}</td>
                    <td class="px-6 py-4 text-sm flex gap-2">
                        <a href="{{ route('admin.umkm.edit', $item->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.umkm.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin hapus?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-medium">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $umkm->links() }}
    </div>
</div>
@endsection