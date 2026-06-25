@extends('layouts.app')

@section('content')
<div>
    <h1>Kelola Kategori</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('admin.kategori.create') }}">+ Tambah Kategori</a>

    <table border="1">
        <tr>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
        @foreach ($kategori as $item)
        <tr>
            <td>{{ $item->nama_kategori }}</td>
            <td>
                <a href="{{ route('admin.kategori.edit', $item->id) }}">Edit</a>
                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $kategori->links() }}
</div>
@endsection