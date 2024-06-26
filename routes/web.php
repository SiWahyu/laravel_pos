<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Kategori\KategoriController;

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