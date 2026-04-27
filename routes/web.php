<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\InformasiController;

// ── Redirect root ke login ────────────────────────────────────────────────────
Route::get('/',          fn() => redirect('/beranda'));
Route::get('/beranda',   [BerandaController::class, 'index'])->name('beranda');
Route::get('/riwayat',   [RiwayatController::class, 'index'])->name('riwayat');
Route::get('/informasi-harga', [InformasiController::class, 'harga'])->name('informasi.harga');
Route::get('/pesan-tiket', [InformasiController::class, 'pesan'])->name('informasi.pesan');

// Transaksi — publik, siapa pun bisa pesan tiket
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

// ── Login ADMIN saja ──────────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ── Halaman Admin (perlu login sebagai admin) ─────────────────────────────────
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/beranda', [WisataController::class, 'index'])->name('admin.beranda');

    Route::get('/admin/edit-wisata', function () {
    return view('admin.edit-wisata');
    })->name('admin.edit');
    
    Route::get('/admin/profil', function () {
    return view('admin.profil');
    })->name('admin.profil');

    Route::get('/wisata/tambah',        [WisataController::class, 'create'])->name('admin.wisata.create');
    Route::post('/wisata',              [WisataController::class, 'store'])->name('admin.wisata.store');

    Route::get('/wisata/{id}/edit',     [WisataController::class, 'edit'])->name('admin.wisata.edit');
    Route::post('/wisata/{id}',         [WisataController::class, 'update'])->name('admin.wisata.update');

    Route::get('/wisata/{id}/hapus',    [WisataController::class, 'destroy'])->name('admin.wisata.destroy');

    Route::get('/riwayat',              [RiwayatController::class, 'adminIndex'])->name('admin.riwayat');
    // Route::get('/profil',               [ProfilController::class, 'adminShow'])->name('admin.profil');
});
