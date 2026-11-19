<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SapaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', function () {
    return view('pages.profil');
});

Route::get('/home', function () {
    return 'Selamat Pagi Dunia, 707082400110';
});

Route::get('/sapa', [SapaController::class, 'index']);

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

// satu controller bisa memiliki beberapa method (perintah)
Route::get('/product', [ProductController::class, 'index']); // untuk menampilkan data
Route::get('/product/addProduct', [ProductController::class, 'addProduct']); // menampilkan form insert data (wajib di atas /product/{id})
Route::post('/product', [ProductController::class, 'store']); // menyimpan data dari form ke database

// BARU Modul 10
Route::get('/product/{id}', [ProductController::class, 'show']); // menampilkan detail produk
Route::get('/product/{id}/edit', [ProductController::class, 'edit']); // menampilkan form edit
Route::put('/product/{id}', [ProductController::class, 'update']); // menyimpan perubahan data
Route::delete('/product/{id}', [ProductController::class, 'destroy']); // menghapus data

// resource controller untuk kategori produk (controller dibuat di B.3)
Route::resource('/category', CategoryController::class);