<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\WisataApiController;
use App\Http\Controllers\Api\PemesananApiController;
use App\Http\Controllers\Api\ProfilApiController;
use App\Http\Controllers\Api\RiwayatApiController;
use App\Http\Controllers\Api\UlasanController;
use App\Http\Controllers\AuthController;

// ─── Public API (tidak perlu token) ─────────────────────────────────────
Route::post('/login',    [AuthApiController::class, 'login']);
Route::post('/google-login', [AuthApiController::class, 'googleLogin']);
Route::post('/register', [AuthApiController::class, 'register']);

Route::get('/wisata',       [WisataApiController::class, 'index']);
Route::get('/wisata/{id}',  [WisataApiController::class, 'show']);
Route::post('/ulasan', [UlasanController::class, 'store']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// ─── Protected API (perlu token Sanctum) ────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',     [AuthApiController::class, 'logout']);

    Route::post('/pemesanan',  [PemesananApiController::class, 'store']);
    Route::get('/riwayat',     [RiwayatApiController::class, 'index']);

    Route::get('/profile',     [ProfilApiController::class, 'show']);
    Route::post('/profile',    [ProfilApiController::class, 'update']);
    Route::post('/profile/update', [ProfilApiController::class, 'update']);
    Route::post('/profile/hapus-foto', [ProfilApiController::class, 'deleteFoto']);
});