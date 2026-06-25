@extends('layouts.public')

@section('content')

    <div class="max-w-7xl mx-auto pt-24 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}" class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition">
                <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Product Image -->
                <div class="md:w-1/2">
                    @if($produk->foto_profil)
                        <img src="{{ asset('storage/' . $produk->foto_profil) }}" alt="{{ $produk->nama_usaha }}" class="w-full h-full object-cover min-h-[300px]">
                    @else
                        <div class="w-full h-full min-h-[300px] bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400">
                            Tidak ada foto
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="md:w-1/2 p-8">
                    <div class="mb-4 flex gap-2 flex-wrap">
                        @if($produk->kategori)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                {{ ucwords(str_replace('_', ' ', $produk->kategori)) }}
                            </span>
                        @endif
                        
                        @if($produk->status == 'ready')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Ready</span>
                        @elseif($produk->status == 'pre_order')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">Pre-Order</span>
                        @elseif($produk->status == 'out_of_stock')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Out of Stock</span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $produk->nama_usaha }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Oleh: {{ $produk->nama_pemilik }}</p>

                    @if($produk->deskripsi_usaha)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Deskripsi</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $produk->deskripsi_usaha }}</p>
                        </div>
                    @endif

                    <div class="space-y-6">
                        @if($produk->alat_bahan)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Alat & Bahan</h3>
                                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                    <div class="text-gray-700 dark:text-gray-300 whitespace-pre-line leading-relaxed">
                                        {{ $produk->alat_bahan }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($produk->langkah_pembuatan)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Langkah Pembuatan</h3>
                                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                    <div class="text-gray-700 dark:text-gray-300 whitespace-pre-line leading-relaxed">
                                        {{ $produk->langkah_pembuatan }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($produk->fungsi_kegunaan)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Fungsi & Kegunaan</h3>
                                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                    <div class="text-gray-700 dark:text-gray-300 whitespace-pre-line leading-relaxed">
                                        {{ $produk->fungsi_kegunaan }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $produk->no_wa) }}" target="_blank" class="inline-flex items-center justify-center w-full px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.573-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824z"></path>
                            </svg>
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
