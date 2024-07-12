<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Kategori\KategoriController;
use App\Http\Controllers\Dashboard\Produk\ProdukController;

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Kategori
    Route::prefix('dashboard/kategori')->group(function () {
        Route::get('', [KategoriController::class, 'index'])->name('kategori.data');
        Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/create', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/{kategori}/edit', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/{kategori}/delete', [KategoriController::class, 'delete'])->name('kategori.delete');
    });

    // Produk
    Route::prefix('dashboard/produk')->group(function () {
        Route::get('', [ProdukController::class, 'index'])->name('produk.data');
        Route::get('/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::get('/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/{produk}/edit', [ProdukController::class, 'update'])->name('produk.update');
        Route::post('/create', [ProdukController::class, 'store'])->name('produk.store');
        Route::delete('/{produk}/delete', [ProdukController::class, 'delete'])->name('produk.delete');
    });

    // Customer
    Route::prefix('dashboard/customer')->group(function () {
        Route::get('', [\App\Http\Controllers\Dashboard\Customer\CustomerController::class, 'index'])->name('customer.data');
        Route::delete('/{customer}/delete', [\App\Http\Controllers\Dashboard\Customer\CustomerController::class, 'delete'])->name('customer.delete');
    });

    // Karyawan
    Route::prefix('dashboard/karyawan')->group(function () {
        Route::get('', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'index'])->name('karyawan.data');
        Route::get('/create', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/create', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/{karyawan}/edit', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::put('/{karyawan}/edit', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('/{karyawan}delete', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'delete'])->name('karyawan.delete');
        Route::get('/akun', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'dataAkun'])->name('karyawan.data-akun');
        Route::get('/{karyawan}/register', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'form-register'])->name('karyawan.create-akun');
        Route::post('/{karyawan}/register', [\App\Http\Controllers\Dashboard\Karyawan\KaryawanController::class, 'register'])->name('karyawan.register');
    });

    Route::get('/produk', [\App\Http\Controllers\Main\Produk\ProdukController::class, 'list'])->name('main.produk-list');
    Route::get('/produk/{produk}', [\App\Http\Controllers\Main\Produk\ProdukController::class, 'detail'])->name('main.produk-detail');

    Route::get('/cart', [\App\Http\Controllers\Customer\CartController::class, 'index'])->name('cart.data');
    Route::post('/cart/{produk}', [\App\Http\Controllers\Customer\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cartItem}', [\App\Http\Controllers\Customer\CartController::class, 'deleteItem'])->name('cart.delete-item');

    Route::get('/order', function () {

        return view('customer.order.checkout');
    })->name('order.checkout');
});


// Auth
Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login')->middleware(middleware: ['guest']);
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\AuthController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\AuthController::class, 'registerUser'])->name('register.register-user');
