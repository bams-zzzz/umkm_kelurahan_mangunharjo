@extends('layouts.guest-public')

@section('content')
<div>
    <a href="{{ route('katalog.index') }}">&larr; Kembali ke Katalog</a>

    <h1>{{ $produk->nama_produk }}</h1>
    <p>Kategori: {{ $produk->kategori->nama_kategori }}</p>
    <p>{{ $produk->deskripsi }}</p>
    <p>Rp {{ number_format($produk->harga, 0, ',', '.') }} / {{ $produk->satuan }}</p>
    <p>Status: {{ $produk->status === 'tersedia' ? 'Tersedia' : 'Habis' }}</p>

    <hr>

    <h3>Informasi UMKM</h3>
    <p>Nama Usaha: {{ $produk->umkm->nama_usaha }}</p>
    <p>Pemilik: {{ $produk->umkm->nama_pemilik }}</p>
    <p>Alamat: {{ $produk->umkm->alamat }}</p>

    @php
        $pesan = "Halo, saya tertarik dengan produk {$produk->nama_produk}";
        $waLink = "https://wa.me/{$produk->umkm->no_wa}?text=" . urlencode($pesan);
    @endphp

    <a href="{{ $waLink }}" target="_blank">Pesan via WhatsApp</a>
</div>
@endsection