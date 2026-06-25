@extends('layouts.app')

@section('content')
<div>
    <h1>Edit Kategori</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
        <button type="submit">Update</button>
    </form>
</div>
@endsection