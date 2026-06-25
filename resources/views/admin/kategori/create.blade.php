@extends('layouts.app')

@section('content')
<div>
    <h1>Tambah Kategori</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}">
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection