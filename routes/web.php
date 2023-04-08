<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
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
        return view('index');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //CRUD Kategori
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/add', [KategoriController::class, 'store']);
    Route::put('/kategori/edit/{id}', [KategoriController::class, 'update']);
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'destroy']);
});
