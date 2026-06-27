@extends('layouts.main')

@section('title', 'Home - Katalog UMKM Mangunharjo')

@section('content')

    <header class="hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/home-page.png') }}'); background-size: cover; background-position: center;">
        <h1>Galeri Produk UMKM<br>UPPKA Bina Usaha</h1>
        <p>Kenali Produk, Proses Produksi, dan Cerita di Balik Setiap Karya Kami</p>
    </header>

    <section class="about-section">
        <div class="about-left">
            <h2>Tentang Kami</h2>
            <p>UPPKA Bina Warga merupakan kelompok usaha peningkatan pendapatan keluarga yang berada di bawah binaan Dinas Pemberdayaan Perempuan dan Perlindungan Anak (Dindanduk) Kota melalui program BKKBN. Kelompok ini telah berdiri sejak tahun 2010 dan menjadi wadah bagi masyarakat di Kelurahan Mangunharjo untuk mengembangkan berbagai usaha produktif.</p>
        </div>
        <div class="about-right">
            <p>Saat ini, UPPKA Bina Warga memiliki 8 anggota yang menjalankan beragam jenis usaha, mulai dari olahan pangan, jasa, hingga produk kreatif. Melalui semangat gotong royong dan pemberdayaan, setiap anggota saling mendukung dalam mengembangkan usahanya. Kehadiran rumah produksi bersama pada tahun 2025 juga menjadi langkah penting dalam meningkatkan kualitas produksi serta memperkuat kolaborasi antaranggota untuk menghasilkan produk yang lebih baik.</p>
        </div>
    </section>

    <section class="katalog" id="produk">
        <div class="katalog-container">
            
            <aside class="sidebar">
                <div id="filter-pangan" style="display: block;">
                    <div class="filter-box">
                        <h4>Olahan Pangan</h4>
                        <label class="filter-item"><input type="checkbox" class="filter-cb" value="Camilan" onchange="filterCards()"> Camilan</label>
                        <label class="filter-item"><input type="checkbox" class="filter-cb" value="Olahan Ikan" onchange="filterCards()"> Olahan Ikan</label>
                        <label class="filter-item"><input type="checkbox" class="filter-cb" value="Olahan Telur" onchange="filterCards()"> Olahan Telur</label>
                        <label class="filter-item"><input type="checkbox" class="filter-cb" value="Minuman" onchange="filterCards()"> Minuman</label>
                    </div>
                </div>

                <div id="filter-jasa" style="display: none;">
                    <div class="filter-box">
                        <h4>Jasa & Produk Lainnya</h4>
                        <label class="filter-item"><input type="checkbox" class="filter-cb" value="Kebutuhan Harian" onchange="filterCards()"> Kebutuhan Harian</label>
                        <label class="filter-item"><input type="checkbox" class="filter-cb" value="Jasa" onchange="filterCards()"> Jasa</label>
                    </div>
                </div>
            </aside>

            <div class="katalog-content">
                <div class="katalog-header">
                    <h2>Katalog Kerajinan Terbaru</h2>
                    <div class="tabs">
                        <span id="tab-pangan" class="active" onclick="switchTab('pangan')">Olahan Pangan</span>
                        <div class="separator"></div>
                        <span id="tab-jasa" onclick="switchTab('jasa')">Jasa & Produk Lainnya</span>
                    </div>
                </div>

                <div class="slider-wrapper">
                    <button class="slide-btn left-btn" onclick="slideLeft()">
                        <img src="{{ asset('images/panah.png') }}" class="arrow-img arrow-left" alt="Kiri">
                    </button>
                    
                    <div class="cards-track" id="sliderTrack">
                        @if($produk->count() > 0)
                            @foreach ($produk as $item)
                                @include('components.product-card')
                            @endforeach
                        @else
                            <p style="text-align: center; color: #888; width: 100%;">Belum ada data produk dari Admin.</p>
                        @endif
                    </div>
                    
                    <button class="slide-btn right-btn" onclick="slideRight()">
                        <img src="{{ asset('images/panah.png') }}" class="arrow-img" alt="Kanan">
                    </button>
                </div>
                
                <div style="margin-top: 30px; display: flex; justify-content: center;">
                    {{ $produk->links('vendor.pagination.simple-custom') }}
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <h2>Hubungi Kami</h2>
        <div class="contact-box">
            <p>📍 <strong>Alamat Sekretariat:</strong><br>Kantor Kelurahan Mangunharjo, Kec. Tugu, Kota Semarang.</p>
            <p>📞 <strong>WhatsApp (Pemesanan):</strong><br>+62 812-3456-XXXX (Ibu Pengurus UMKM)</p>
            <p>✉️ <strong>Email:</strong><br>umkm.mangunharjo@gmail.com</p>
            <p class="note">*Setiap pembelian produk kerajinan ini turut mendukung program ekonomi sirkular dan kebersihan lingkungan kelurahan kami.</p>
        </div>
    </section>

    <div class="modal-overlay" id="productModal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal()">
                <img src="{{ asset('images/X-bar.png') }}" class="x-img" alt="Tutup">
            </button>
            <div class="modal-title" id="modalTitle">Nama Produk</div>
            
            <div class="modal-img" id="modalImg"></div>
            
            <div class="modal-info">
                <h4>Alat dan Bahan</h4>
                <ul id="modalBahan"></ul>
                
                <h4>Langkah pembuatan</h4>
                <ul id="modalLangkah"></ul>
                
                <h4>Fungsi dan Kegunaan</h4>
                <ul id="modalFungsi"></ul>
                
                <div class="modal-author" id="modalAuthor">
                    Dibuat oleh<br>"..."
                </div>

                <div class="modal-actions">
                    <button class="btn-kembali" onclick="closeModal()">Kembali</button>
                    <a href="#" target="_blank" id="modalWaBtn" class="btn-wa" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset('images/Logo-WA.png') }}" class="wa-img" alt="WA"> Hubungi Pembuat
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection