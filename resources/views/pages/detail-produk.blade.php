@extends('layouts.main')

@section('title', $produk->nama_produk . ' - UMKM Mangunharjo')

@section('content')

    <section class="section-container" style="background-color: #f9f9f9;">
        <div style="max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px;">

            <h2>{{ $produk->nama_produk }}</h2>
            <p>Kategori: {{ $produk->kategori->nama_kategori ?? '-' }}</p>

            @if($produk->foto)
                <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}" style="margin: 20px 0; width: 100%; max-height: 300px; object-fit: cover;">
            @else
                <div style="margin: 20px 0; background-color: #e67e22; width: 100%; height: 300px; display: flex; align-items: center; justify-content: center; color: white;">
                    Foto belum tersedia
                </div>
            @endif

            <div class="detail-section">
                <h4>Alat dan Bahan:</h4>
                <p>{{ $produk->alat_bahan ?? '-' }}</p>
            </div>

            <div class="detail-section">
                <h4>Langkah Pembuatan:</h4>
                <p>{{ $produk->langkah_pembuatan ?? '-' }}</p>
            </div>

            <div class="detail-section">
                <h4>Fungsi dan Kegunaan:</h4>
                <p>{{ $produk->fungsi_kegunaan ?? '-' }}</p>
            </div>

            <p style="margin-top: 30px;">Dibuat oleh: {{ $produk->umkm->nama_pemilik ?? '-' }} ({{ $produk->umkm->alamat ?? '-' }})</p>

            <a href="{{ url()->previous() }}" style="display: inline-block; background-color: #7ced7c; padding: 10px 20px; text-decoration: none; color: #000; border-radius: 5px; font-weight: bold; margin-top: 20px;">Kembali</a>
        </div>
    </section>

@endsection