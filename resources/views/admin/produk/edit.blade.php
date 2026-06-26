@extends('layouts.app')

@section('content')
<div>
    <h1>Edit Produk</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama Produk</label>
        <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}">

        <label>Deskripsi</label>
        <textarea name="deskripsi">{{ old('deskripsi', $produk->deskripsi) }}</textarea>

        <label>Harga (Rp)</label>
        <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}">

        <label>Satuan</label>
        <input type="text" name="satuan" value="{{ old('satuan', $produk->satuan) }}">

        <label>Status</label>
        <select name="status">
            <option value="ready" @selected($produk->status === 'ready')>Ready</option>
            <option value="pre_order" @selected($produk->status === 'pre_order')>Pre-Order</option>
            <option value="out_of_stock" @selected($produk->status === 'out_of_stock')>Out of Stock</option>
            <option value="tersedia" @selected($produk->status === 'tersedia')>Tersedia</option>
            <option value="habis" @selected($produk->status === 'habis')>Habis</option>
        </select>

        <label>Alat dan Bahan</label>
        <textarea name="alat_bahan">{{ old('alat_bahan', $produk->alat_bahan) }}</textarea>

        <label>Langkah Pembuatan</label>
        <textarea name="langkah_pembuatan">{{ old('langkah_pembuatan', $produk->langkah_pembuatan) }}</textarea>

        <label>Fungsi / Keunggulan</label>
        <textarea name="fungsi_kegunaan">{{ old('fungsi_kegunaan', $produk->fungsi_kegunaan) }}</textarea>

        <label>Foto Produk (kosongkan jika tidak ganti)</label>
        <input type="file" name="foto">

        <label>
            <input type="checkbox" name="is_featured" value="1" @checked($produk->is_featured)>
            Tampilkan sebagai produk unggulan
        </label>

        <label>Kategori</label>
        <select name="kategori_id">
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}" @selected($produk->kategori_id == $kat->id)>{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>

        <label>UMKM</label>
        <select name="umkm_id">
            @foreach ($umkm as $u)
                <option value="{{ $u->id }}" @selected($produk->umkm_id == $u->id)>{{ $u->nama_usaha }}</option>
            @endforeach
        </select>

        <button type="submit">Update</button>
    </form>
</div>
@endsection