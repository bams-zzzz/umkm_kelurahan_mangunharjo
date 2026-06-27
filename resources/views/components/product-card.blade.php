@php
    $kategoriPangan = ['Camilan', 'Olahan Ikan', 'Olahan Telur', 'Minuman'];
    $namaKategori = $item->kategori->nama_kategori ?? '';
    $isPangan = in_array($namaKategori, $kategoriPangan);
    $mainType = $isPangan ? 'pangan' : 'jasa';

    $waNumber = preg_replace('/[^0-9]/', '', $item->umkm->no_wa ?? '');
    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }
@endphp

<div class="card" data-tab="{{ $mainType }}" data-category="{{ $namaKategori }}">
    <div class="card-img-placeholder" style="padding: 0; overflow: hidden; background: transparent;">
        @if($item->foto)
            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover;">
        @else
            <div style="background: #fff; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #888;">FOTO 1:1</div>
        @endif
    </div>

    <h3 class="card-title">{{ $item->nama_produk }}</h3>
    <p class="card-cat">{{ $namaKategori }}</p>

    <button class="card-btn"
            onclick="openModal(this)"
            data-title="{{ $item->nama_produk }}"
            data-img="{{ $item->foto ? asset('storage/' . $item->foto) : '' }}"
            data-author="{{ $item->umkm->nama_pemilik ?? '-' }} ({{ $item->umkm->alamat ?? '-' }})"
            data-wa="{{ $waNumber }}"
            data-bahan="{{ $item->alat_bahan }}"
            data-langkah="{{ $item->langkah_pembuatan }}"
            data-fungsi="{{ $item->fungsi_kegunaan }}">
        Lihat Detail
    </button>
</div>