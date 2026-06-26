@php
    $isPangan = in_array($item->kategori, ['makanan', 'minuman']);
    $mainType = $isPangan ? 'pangan' : 'kerajinan';
    $waNumber = preg_replace('/[^0-9]/', '', $item->no_wa);
    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }
@endphp

<div class="produk-card" data-main="{{ $mainType }}" data-kategori="{{ $item->kategori }}">
    <div class="card-image-box">
        @if($item->foto_profil)
            <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama_usaha }}">
        @else
            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#e00; color:#fff;">Foto 1:1</div>
        @endif
    </div>
    
    <div class="produk-info">
        <h4>{{ $item->nama_usaha }}</h4>
        <p style="text-transform: capitalize; font-size: 13px; color: #e67e22; font-weight: bold;">{{ str_replace('_', ' ', $item->kategori) }}</p>
    </div>
    
    <button class="btn-detail" 
            data-title="{{ $item->nama_usaha }}" 
            data-img="{{ $item->foto_profil ? asset('storage/' . $item->foto_profil) : '' }}"
            data-author="{{ $item->nama_pemilik }} ({{ $item->alamat }})<br>📞 WA: <a href='https://wa.me/{{ $waNumber }}' target='_blank' style='color: #25D366; text-decoration: none; font-weight: bold;'>{{ $item->no_wa }}</a>"
            data-bahan="{{ $item->alat_bahan }}"
            data-langkah="{{ $item->langkah_pembuatan }}"
            data-fungsi="{{ $item->fungsi_kegunaan }}">
        Lihat Detail
    </button>
</div>