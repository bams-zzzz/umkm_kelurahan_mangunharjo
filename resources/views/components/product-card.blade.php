@php
    $pangaKategori = ['camilan', 'olahan_ikan', 'olahan_telur', 'minuman'];
    $tabType = in_array($item->kategori, $pangaKategori) ? 'pangan' : 'jasa';
    
    $kategoriLabel = [
        'camilan' => 'Camilan',
        'olahan_ikan' => 'Olahan Ikan',
        'olahan_telur' => 'Olahan Telur',
        'minuman' => 'Minuman',
        'kebutuhan_harian' => 'Kebutuhan Harian',
        'jasa' => 'Jasa',
    ];
@endphp

<div class="card d-none" 
     data-tab="{{ $tabType }}" 
     data-category="{{ $kategoriLabel[$item->kategori] ?? $item->kategori }}">
    
    <div class="card-image-box">
        @if($item->foto_profil)
            <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama_produk }}">
        @else
            <span style="color: #888; font-size: 14px;">FOTO 1:1</span>
        @endif
    </div>

    <div class="produk-info">
        <h4>{{ $item->nama_produk }}</h4>
        <p style="text-transform: capitalize; font-size: 13px; color: #e67e22; font-weight: bold;">
            {{ $kategoriLabel[$item->kategori] ?? $item->kategori }}
        </p>
    </div>

<button class="card-btn"
        onclick="openModal(this)"
        data-title="{{ $item->nama_produk }}"
        data-img="{{ $item->foto_profil ? asset('storage/' . $item->foto_profil) : '' }}"
        data-author="{{ $item->nama_pemilik }} ({{ $item->alamat }})"
        data-deskripsi="{{ $item->deskripsi_produk }}"
        data-wa="{{ $item->no_wa }}"
        data-bahan="{{ $item->bahan_dan_proses_produksi }}"
        data-keunggulan="{{ $item->keunggulan_produk }}"
        data-lokasi="{{ $item->lokasi_usaha }}">
    Lihat Detail
</button>
</div>