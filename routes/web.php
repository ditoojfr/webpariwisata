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
Route::get('/cara-pesan', function () {
    return view('informasi.cara-pesan');
})->name('informasi.cara-pesan');
Route::get('/tiket', function () {
    return view('tiket');
})->name('tiket');

// Transaksi — publik, siapa pun bisa pesan tiket
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

// ── Login ADMIN saja ──────────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');


// ── Halaman Admin (perlu login sebagai admin) ─────────────────────────────────
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/beranda',        [WisataController::class,  'index'])->name('admin.beranda');

    // Tidak pakai {id} — wisata diambil otomatis dari session admin
    Route::get('/wisata/edit',    [WisataController::class,  'edit'])->name('admin.edit');
    Route::put('/wisata/update', [WisataController::class, 'update'])->name('admin.wisata.update');
    Route::get('/riwayat',        [RiwayatController::class, 'adminIndex'])->name('admin.riwayat');
    Route::get('/profil',         [ProfilController::class,  'adminShow'])->name('admin.profil');
    Route::put('/profil/update', [ProfilController::class, 'adminUpdate'])->name('admin.profil.update');
    Route::delete('/profil/delete', [ProfilController::class, 'adminDelete'])->name('admin.profil.delete'); 
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    // Pastikan baris ini ada di dalam group admin
Route::delete('/galeri/{id}', [WisataController::class, 'hapusEvent'])->name('admin.galeri.destroy');
});
