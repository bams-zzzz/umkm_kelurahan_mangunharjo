@php
    $kategoriPangan = ['Camilan', 'Olahan Ikan', 'Olahan Telur', 'Minuman'];
    $isPangan = in_array($item->kategori, $kategoriPangan);
    $mainType = $isPangan ? 'pangan' : 'jasa';
    
    // PENGAMAN: Kasih ?? '' biar kalau database kosong gak bikin web crash
    $waNumber = preg_replace('/[^0-9]/', '', $item->no_wa ?? '');
    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }
@endphp

<div class="card" data-tab="{{ $mainType }}" data-category="{{ $item->kategori }}">
    <div class="card-img-placeholder" style="padding: 0; overflow: hidden; background: transparent;">
        @if($item->foto_profil)
            <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama_usaha }}" style="width: 100%; height: 100%; object-fit: cover;">
        @else
            <div style="background: #fff; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #888;">FOTO 1:1</div>
        @endif
    </div>
    
    <h3 class="card-title">{{ $item->nama_usaha }}</h3>
    <p class="card-cat">{{ $item->kategori }}</p>
    
    <button class="card-btn" 
            onclick="openModal(this)"
            data-title="{{ $item->nama_usaha }}"
            data-img="{{ $item->foto_profil ? asset('storage/' . $item->foto_profil) : '' }}"
            data-author="{{ $item->nama_pemilik }} ({{ $item->alamat }})"
            data-wa="{{ $waNumber }}"
            data-bahan="{{ $item->alat_bahan }}"
            data-langkah="{{ $item->langkah_pembuatan }}"
            data-fungsi="{{ $item->fungsi_kegunaan }}">
        Lihat Detail
    </button>
</div>