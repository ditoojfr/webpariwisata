<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UlasanWisata;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function store(Request $request)
{
    // 1. Validasi input
    $request->validate([
        'id_wisata'   => 'required',
        'id_customer' => 'required',
        'ulasan'      => 'required',
    ]);

    // 2. Simpan ulasan ke database
    $ulasan = UlasanWisata::create([
        'id_wisata'   => $request->id_wisata,
        'id_customer' => $request->id_customer,
        'ulasan'      => $request->ulasan,
        'tanggal'     => now(),
    ]);

    // 3. Ambil ulang SEMUA ulasan untuk wisata ini (Biar Flutter bisa langsung update list)
    // GANTI $id JADI $request->id_wisata DI SINI BRE!
    $allReviews = UlasanWisata::with('customer')
        ->where('id_wisata', $request->id_wisata) 
        ->orderBy('tanggal', 'desc')
        ->get();

    return response()->json([
        'status'  => 'success',
        'message' => 'Review berhasil disimpan',
        'data'    => $allReviews // Kirim list ulasan terbaru ke Flutter
    ], 201);
}
}