@extends('layouts.public')

@section('content')

@if($produk->count() == 0 && request()->has('search'))
    <div class="max-w-3xl mx-auto pt-24 mb-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-10 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Pencarian Tidak Ditemukan</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8">Maaf, kami tidak dapat menemukan produk yang cocok dengan kata kunci "<strong>{{ request('search') }}</strong>".</p>
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
                Kembali ke Katalog
            </a>
        </div>
    </div>
@else
    <!-- Hero Section -->
    <div id="home" class="max-w-7xl mx-auto pt-24 pb-8 px-4 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-6 text-center">Selamat Datang di Katalog UMKM Kelurahan Mangunharjo</h1>
                
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 text-lg leading-relaxed text-center">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus. Mauris iaculis porttitor posuere. Praesent id metus massa, ut blandit odio. Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor.
                    </p>
                    <p class="mt-4">
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.
                    </p>
                    <div class="mt-8 text-center">
                        <a href="#produk" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
                            Lihat Katalog Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Catalog Section -->
    <div id="produk" class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="w-full md:w-1/4">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b pb-2 dark:border-gray-700">Filter</h2>
                    
                    <form action="{{ route('home') }}#produk" method="GET">
                        @if(request()->has('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <div class="mb-6">
                            <h3 class="font-medium text-gray-900 dark:text-gray-200 mb-3">Kategori</h3>
                            <div class="space-y-2">
                                @php
                                    $kategoriOptions = ['plastik' => 'Plastik', 'kardus' => 'Kardus', 'ban_bekas' => 'Ban Bekas', 'kaca' => 'Kaca'];
                                @endphp
                                @foreach($kategoriOptions as $value => $label)
                                    <div class="flex items-center">
                                        <input id="cat_{{ $value }}" name="kategori" value="{{ $value }}" type="radio" {{ request('kategori') == $value ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                        <label for="cat_{{ $value }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="font-medium text-gray-900 dark:text-gray-200 mb-3">Status</h3>
                            <div class="space-y-2">
                                @php
                                    $statusOptions = ['ready' => 'Ready', 'pre_order' => 'Pre-Order', 'out_of_stock' => 'Out of Stock'];
                                @endphp
                                @foreach($statusOptions as $value => $label)
                                    <div class="flex items-center">
                                        <input id="status_{{ $value }}" name="status" value="{{ $value }}" type="radio" {{ request('status') == $value ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                        <label for="status_{{ $value }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded transition">
                                Terapkan
                            </button>
                            @if(request()->has('kategori') || request()->has('status') || request()->has('search'))
                                <a href="{{ route('home') }}#produk" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium py-2 px-4 rounded transition">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="w-full md:w-3/4">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Katalog Produk</h1>
                    @if(request('search'))
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Hasil pencarian untuk: "{{ request('search') }}"</p>
                    @endif
                </div>

                @if($produk->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($produk as $item)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col hover:shadow-lg transition">
                                @if($item->foto_profil)
                                    <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama_usaha }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                        Tidak ada foto
                                    </div>
                                @endif
                                
                                <div class="p-5 flex-grow flex flex-col">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $item->nama_usaha }}</h3>
                                    
                                    <div class="mb-4 flex gap-2 flex-wrap">
                                        @if($item->kategori)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                {{ ucwords(str_replace('_', ' ', $item->kategori)) }}
                                            </span>
                                        @endif
                                        
                                        @if($item->status == 'ready')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Ready</span>
                                        @elseif($item->status == 'pre_order')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">Pre-Order</span>
                                        @elseif($item->status == 'out_of_stock')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Out of Stock</span>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-auto pt-4">
                                        <a href="{{ route('produk.detail', $item->id) }}" class="block w-full text-center bg-blue-50 text-blue-600 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50 py-2 px-4 rounded text-sm font-medium transition">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8">
                        {{ $produk->links() }}
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8 text-center">
                        <p class="text-gray-600 dark:text-gray-400">Tidak ada produk yang ditemukan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
@endsection
