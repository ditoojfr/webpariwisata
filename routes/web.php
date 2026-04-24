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
Route::get('/', fn() => redirect('/login'));

// ── Auth (halaman publik, tidak perlu login) ──────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);          // ← harus POST, return JSON

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);       // ← harus POST, return JSON

Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google',           [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback',  [AuthController::class, 'handleGoogleCallback']);
Route::post('/auth/google/token',    [AuthController::class, 'handleGoogleToken']); // ← dari JS blade

// ── Halaman User (perlu login sebagai user) ───────────────────────────────────
Route::middleware('user')->group(function () {
    Route::get('/beranda',    [BerandaController::class, 'index'])->name('beranda');
    Route::get('/riwayat',    [RiwayatController::class, 'index'])->name('riwayat');

    Route::get('/informasi-harga', [InformasiController::class, 'harga'])->name('informasi.harga');
    Route::get('/pesan-tiket', [InformasiController::class, 'pesan'])->name('informasi.pesan');

    Route::get('/profil',     [ProfilController::class, 'show'])->name('profil');
    Route::post('/profil',    [ProfilController::class, 'update']);
    Route::delete('/profil',  [ProfilController::class, 'destroy']);

    // Transaksi (AJAX dari beranda)
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
});

// ── Halaman Admin (perlu login sebagai admin) ─────────────────────────────────
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/beranda',              [WisataController::class, 'index'])->name('admin.beranda');

    Route::get('/wisata/tambah',        [WisataController::class, 'create'])->name('admin.wisata.create');
    Route::post('/wisata',              [WisataController::class, 'store'])->name('admin.wisata.store');

    Route::get('/wisata/{id}/edit',     [WisataController::class, 'edit'])->name('admin.wisata.edit');
    Route::post('/wisata/{id}',         [WisataController::class, 'update'])->name('admin.wisata.update');

    Route::get('/wisata/{id}/hapus',    [WisataController::class, 'destroy'])->name('admin.wisata.destroy');

    Route::get('/riwayat',              [RiwayatController::class, 'adminIndex'])->name('admin.riwayat');
    Route::get('/profil',               [ProfilController::class, 'adminShow'])->name('admin.profil');
});
