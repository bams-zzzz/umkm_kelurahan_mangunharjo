@extends('layouts.main')

@section('title', 'Home - Katalog UMKM Mangunharjo')

@section('content')

    <header class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Galeri Produk UMKM<br>Kelurahan Mangunharjo</h1>
            <p>Kenali Produk, Proses Produksi, dan Cerita di Balik Setiap Karya Kami</p>
        </div>
    </header>

    <section id="produk" class="section-container" style="background-color: #f9f9f9;">
        <h2 style="text-align: center; margin-bottom: 20px;">Katalog Kerajinan Terbaru</h2>
        
        <div class="katalog-tabs">
            <button class="tab-btn active" data-target="kerajinan">Kerajinan Tangan</button>
            <div class="tab-separator"></div>
            <button class="tab-btn" data-target="pangan">Olahan Pangan</button>
        </div>

        <div class="katalog-wrapper">
            <aside class="katalog-sidebar">
                <div id="filter-kerajinan">
                    <h3 style="text-align: center;">Kategori Bahan</h3>
                    <ul class="kategori-list">
                        <li><input type="checkbox" id="plastik" class="filter-cb" data-type="kerajinan" value="plastik"> <label for="plastik">Plastik</label></li>
                        <li><input type="checkbox" id="kardus" class="filter-cb" data-type="kerajinan" value="kardus"> <label for="kardus">Kardus/Kertas</label></li>
                        <li><input type="checkbox" id="ban_bekas" class="filter-cb" data-type="kerajinan" value="ban_bekas"> <label for="ban_bekas">Ban Bekas</label></li>
                        <li><input type="checkbox" id="kaca" class="filter-cb" data-type="kerajinan" value="kaca"> <label for="kaca">Kaca</label></li>
                    </ul>
                </div>
                <div id="filter-pangan" style="display: none;">
                    <h3 style="text-align: center;">Kategori Pangan</h3>
                    <ul class="kategori-list">
                        <li><input type="checkbox" id="makanan" class="filter-cb" data-type="pangan" value="makanan"> <label for="makanan">Makanan</label></li>
                        <li><input type="checkbox" id="minuman" class="filter-cb" data-type="pangan" value="minuman"> <label for="minuman">Minuman</label></li>
                    </ul>
                </div>
            </aside>

            <div class="katalog-grid">
                @if($produk->count() > 0)
                    @foreach ($produk as $item)
                        @include('components.product-card')
                    @endforeach
                @else
                    <p style="grid-column: 1/-1; text-align: center; color: #888; padding: 40px 0;">Belum ada data produk dari Admin.</p>
                @endif
            </div>
        </div>

        <div style="margin-top: 30px; display: flex; justify-content: center;">
            {{ $produk->links() }}
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