@extends('layouts.main')

@section('title', 'Katalog Semua Produk - UMKM Mangunharjo')

@section('content')

    <section class="section-container">
        <h2 style="text-align: center; margin-bottom: 40px;">Semua Koleksi UMKM Kelurahan Mangunharjo</h2>
        
        <div class="katalog-wrapper">
            @foreach($umkm as $item)
                @include('components.product-card', ['item' => $item])
            @endforeach
        </div>
    </section>

    <div id="productModal" class="modal">
        <div class="modal-content">
            <img src="{{ asset('images/x-bar.png') }}" class="close-btn" id="closeModal" alt="Close">
            <h2 id="modalTitle">Nama Produk</h2>
            <div id="modalImageContainer" class="modal-image-placeholder"></div>

            <div class="detail-section">
                <h4>Alat dan Bahan</h4>
                <ul id="modalBahan"></ul>
            </div>
            <div class="detail-section">
                <h4>Langkah Pembuatan</h4>
                <ol id="modalLangkah"></ol>
            </div>
            <div class="detail-section">
                <h4>Fungsi dan Kegunaan</h4>
                <p id="modalFungsi"></p>
            </div>

            <p id="modalAuthor" class="modal-author">Dibuat oleh<br>"..."</p>
            <button id="backModal" class="btn-back">Back</button>
        </div>
    </div>

@endsection