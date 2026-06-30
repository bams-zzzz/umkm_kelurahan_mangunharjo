@extends('layouts.main')

@section('title', 'Katalog Semua Produk - UMKM Mangunharjo')

@section('content')

    <section class="katalog" style="padding-top: 30px;">
        <h2 style="text-align: center; margin-bottom: 40px;">Semua Koleksi UMKM Kelurahan Mangunharjo</h2>

        <div class="katalog-grid">
            @forelse($produk as $item)
                @include('components.product-card')
            @empty
                <p style="text-align: center; color: #888; width: 100%;">Produk tidak ditemukan.</p>
            @endforelse
        </div>
    </section>

    @include('components.product-modal')

@endsection