@extends('layouts.main')

@section('title', 'Detail Produk - UMKM Mangunharjo')

@section('content')

    <section class="section-container" style="background-color: #f9f9f9;">
        <div style="max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px;">
            
            {{-- Nanti temen backend lu tinggal narik data spesifik di sini --}}
            <h2>Nama Produk Dinamis</h2>
            <p>Kategori: Bahan ...</p>
            
            <div style="margin: 20px 0; background-color: #e67e22; width: 100%; height: 300px; display: flex; align-items: center; justify-content: center; color: white;">
                Placeholder Foto Produk Besar
            </div>

            <div class="detail-section">
                <h4>Alat dan Bahan:</h4>
                </div>
            
            <div class="detail-section">
                <h4>Langkah Pembuatan:</h4>
                </div>

            <p style="margin-top: 30px;">Dibuat oleh: Warga RT/RW ...</p>
            
            <a href="{{ url()->previous() }}" style="display: inline-block; background-color: #7ced7c; padding: 10px 20px; text-decoration: none; color: #000; border-radius: 5px; font-weight: bold; margin-top: 20px;">Kembali</a>
        </div>
    </section>

@endsection