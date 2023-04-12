<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//penggunaan middleware di akhir route tambahkan ->middleware('auth')

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.process');
});


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('produk');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/getProduksByKategori/{id}', [ProdukController::class, 'getProdukByKategori'])->name('produk.getByKategori');

    Route::get('/produk/add', [ProdukController::class, 'create']);
    // store = menyimpan data yang baru diinput
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit']);
    Route::get('/produk/{id}/delete', [ProdukController::class, 'destroy']);

    Route::post('/produk', [ProdukController::class, 'store']);
    Route::put('/produk/{id}', [ProdukController::class, 'update']);

    //Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/cart/add', [CartController::class, 'tambahCart']);
    Route::get('/cart/{id}', [CartController::class, 'index'])->name('cart.id');
    Route::get('/item/add/{id}', [CartController::class, 'tambahItem']);
    Route::get('/item/update/{id}', [CartController::class, 'updateItem']);

    //CRUD KATEGORI
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/add', [KategoriController::class, 'store']);
    Route::put('/kategori/edit/{id}', [KategoriController::class, 'update']);
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'destroy']);


    Route::delete('/cart/{cart_id}/delete/{item_id}', [CartController::class, 'hapusItem']);
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.id');
    Route::post('/bayar/{id}', [TransaksiController::class, 'store'])->name('transaksi.store');
});
