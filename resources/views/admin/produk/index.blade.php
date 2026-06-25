@extends('layouts.app')

@section('content')
<div>
    <h1>Kelola Produk</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('admin.produk.create') }}">+ Tambah Produk</a>

    <table border="1">
        <tr>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>UMKM</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach ($produk as $item)
        <tr>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->kategori->nama_kategori }}</td>
            <td>{{ $item->umkm->nama_usaha }}</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <a href="{{ route('admin.produk.edit', $item->id) }}">Edit</a>
                <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $produk->links() }}
</div>
@endsection