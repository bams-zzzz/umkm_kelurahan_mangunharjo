<div class="modal-overlay" id="productModal">
    <div class="modal-content">
        <button class="close-btn" onclick="closeModal()">
            <img src="{{ asset('images/X-bar.png') }}" class="x-img" alt="Tutup">
        </button>
        <div class="modal-title" id="modalTitle">Nama Produk</div>

        <div class="modal-img" id="modalImg"></div>

        <div class="modal-info">
            <h4>Deskripsi Produk</h4>
            <ul id="modalDeskripsi"></ul>

            <h4>Bahan dan Proses Produksi</h4>
            <ul id="modalBahan"></ul>

            <h4>Keunggulan Produk</h4>
            <ul id="modalKeunggulan"></ul>

            <h4>Lokasi Usaha</h4>
            <ul id="modalLokasi"></ul>

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