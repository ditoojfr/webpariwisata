<?php

namespace App\Http\Controllers;

use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // Riwayat untuk user yang sedang login
    public function index()
    {
        $id_customer = session('id_customer');

        $riwayat = RiwayatTransaksi::with(['transaksi.wisata'])
            ->where('id_customer', $id_customer)
            ->orderBy('tgl_pesanan', 'desc')
            ->get();

        return view('riwayat', compact('riwayat'));
    }

    // Riwayat semua user untuk admin
    public function adminIndex()
    {
        $riwayat = RiwayatTransaksi::with(['transaksi.wisata'])
            ->orderBy('tgl_pesanan', 'desc')
            ->get();

        return view('admin.riwayat', compact('riwayat'));
    }
}