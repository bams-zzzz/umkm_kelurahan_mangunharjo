@extends('layouts.app')

@section('content')
<div>
    <h1>Tambah Produk</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nama Produk</label>
        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}">

        <label>Deskripsi</label>
        <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>

        <label>Harga (Rp)</label>
        <input type="number" name="harga" value="{{ old('harga') }}">

        <label>Satuan (misal: per bungkus, per kg)</label>
        <input type="text" name="satuan" value="{{ old('satuan') }}">

        <label>Status</label>
        <select name="status">
            <option value="tersedia">Tersedia</option>
            <option value="habis">Habis</option>
        </select>

        <label>Foto Produk</label>
        <input type="file" name="foto">

        <label>
            <input type="checkbox" name="is_featured" value="1">
            Tampilkan sebagai produk unggulan
        </label>

        <label>Kategori</label>
        <select name="kategori_id">
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>

        <label>UMKM</label>
        <select name="umkm_id">
            @foreach ($umkm as $u)
                <option value="{{ $u->id }}">{{ $u->nama_usaha }}</option>
            @endforeach
        </select>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection