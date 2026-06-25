@extends('layouts.guest-public')

@section('content')
<div>
    <h1>Katalog Produk UMKM Desa</h1>

    <form method="GET" action="{{ route('katalog.index') }}">
        <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
        <select name="kategori_id">
            <option value="">Semua Kategori</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}" @selected(request('kategori_id') == $kat->id)>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
        <button type="submit">Cari</button>
    </form>

    @if ($produk->isEmpty())
        <p>Belum ada produk tersedia.</p>
    @endif

    @foreach ($produk as $item)
        <div>
            <h3>{{ $item->nama_produk }}</h3>
            <p>{{ Str::limit($item->deskripsi, 100) }}</p>
            <p>Rp {{ number_format($item->harga, 0, ',', '.') }} / {{ $item->satuan }}</p>
            <p>Kategori: {{ $item->kategori->nama_kategori }}</p>
            <p>UMKM: {{ $item->umkm->nama_usaha }}</p>
            <a href="{{ route('katalog.show', $item->id) }}">Lihat Detail</a>
        </div>
    @endforeach

    {{ $produk->links() }}
</div>
@endsection