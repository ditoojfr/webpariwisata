<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;

class RiwayatApiController extends Controller
{
    // GET /api/riwayat?id_customer=xxx (menggantikan get_riwayat.php)
    public function index(Request $request)
    {
        $id_customer = $request->query('id_customer');

        if (!$id_customer) {
            return response()->json(['status' => 'error', 'message' => 'ID customer tidak ditemukan']);
        }

        $riwayat = RiwayatTransaksi::with(['transaksi.wisata'])
            ->whereHas('transaksi', fn($q) => $q->where('id_customer', $id_customer))
            ->orderBy('tgl_pesanan', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id_transaksi'       => $item->id_riwayat,
                    'nama_wisata'        => $item->transaksi->wisata->nama_wisata ?? '-',
                    'lokasi'             => $item->transaksi->wisata->lokasi ?? '-',
                    'tanggal'            => $item->tgl_pesanan,
                    'total_harga'        => (int) $item->harga_total,
                    'status'             => $item->status,
                    'metode_pembayaran'  => 'QRIS',
                ];
            });

        return response()->json($riwayat);
    }
}