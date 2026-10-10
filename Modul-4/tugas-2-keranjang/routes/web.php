<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    [KeranjangController::class, 'index']
)->name('barang.index');

Route::get(
    '/keranjang',
    [KeranjangController::class, 'keranjang']
)->name('keranjang.index');

Route::post(
    '/barang/{barang}/tambah',
    [KeranjangController::class, 'tambah']
)->name('keranjang.tambah');

Route::post(
    '/barang/{barang}/plus',
    [KeranjangController::class, 'tambahJumlah']
)->name('keranjang.plus');

Route::post(
    '/barang/{barang}/minus',
    [KeranjangController::class, 'kurangJumlah']
)->name('keranjang.minus');

Route::delete(
    '/barang/{barang}',
    [KeranjangController::class, 'hapus']
)->name('keranjang.hapus');

Route::delete(
    '/keranjang',
    [KeranjangController::class, 'kosongkan']
)->name('keranjang.kosongkan');