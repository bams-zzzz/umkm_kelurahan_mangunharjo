<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KategoriProdukController;
use App\Http\Controllers\HomeController;

// Halaman publik
Route::get('/', [UmkmController::class, 'publik'])->name('home');
Route::get('/produk/{id}', [UmkmController::class, 'detail'])->name('produk.detail');

// Auth (dari Breeze)
require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return redirect()->route('admin.umkm.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin CRUD (protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('umkm', UmkmController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriProdukController::class);
});