@php
    $pangaKategori = ['Camilan', 'Olahan Ikan', 'Olahan Telur', 'Minuman'];
    $namaKategori = $item->kategori->nama_kategori ?? '';
    $tabType = in_array($namaKategori, $pangaKategori) ? 'pangan' : 'jasa';
@endphp

<div class="card d-none"
     data-tab="{{ $tabType }}"
     data-category="{{ $namaKategori }}">

    <div class="card-image-box">
        @if($item->foto && $item->foto !== 'default.jpg')
            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_produk }}">
        @else
            <span style="color: #888; font-size: 14px;">FOTO 1:1</span>
        @endif
    </div>

    <div class="produk-info">
        <h4>{{ $item->nama_produk }}</h4>
        <p style="text-transform: capitalize; font-size: 13px; color: #e67e22; font-weight: bold;">
            {{ $namaKategori }}
        </p>
    </div>

<button class="card-btn"
        onclick="openModal(this)"
        data-title="{{ $item->nama_produk }}"
        data-img="{{ ($item->foto && $item->foto !== 'default.jpg') ? asset('storage/' . $item->foto) : '' }}"
        data-author="{{ $item->umkm->nama_pemilik ?? '' }} ({{ $item->umkm->alamat ?? '' }})"
        data-deskripsi="{{ $item->deskripsi }}"
        data-wa="{{ $item->umkm->no_wa ?? '' }}"
        data-bahan="{{ $item->alat_bahan }}"
        data-keunggulan="{{ $item->fungsi_kegunaan }}"
        data-lokasi="{{ $item->umkm->lokasi_usaha ?? '' }}">
    Lihat Detail
</button>
</div>