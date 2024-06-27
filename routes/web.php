<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Kategori\KategoriController;
use App\Http\Controllers\Dashboard\Produk\ProdukController;

Route::get('/', function () {
    return view('index');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('dashboard/kategori')->group(function () {
    Route::get('', [KategoriController::class, 'index'])->name('kategori.data');
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/create', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/{kategori}/edit', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/{kategori}/delete', [KategoriController::class, 'delete'])->name('kategori.delete');
});

Route::prefix('dashboard/produk')->group(function () {
    Route::get('', [ProdukController::class, 'index'])->name('produk.data');
    Route::get('/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::get('/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/{produk}/edit', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/create', [ProdukController::class, 'store'])->name('produk.store');
    Route::delete('/{produk}/delete', [ProdukController::class, 'delete'])->name('produk.delete');
});