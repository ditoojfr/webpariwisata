<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;

class PemesananApiController extends Controller
{
    // POST /api/pemesanan (menggantikan insert_pemesanan.php)
    public function store(Request $request)
    {
        $nama_customer = trim($request->post('nama_customer', ''));
        $tlp_costumer  = trim($request->post('tlp_costumer', ''));
        $tanggal       = $request->post('tanggal', '');
        $jml_tiket     = intval($request->post('jml_tiket', 0));
        $harga_total   = intval($request->post('harga_total', 0));
        $id_wisata     = intval($request->post('id_wisata', 0));
        $id_customer   = intval($request->post('id_customer', 0));

        if (!$nama_customer || !$tlp_costumer || !$tanggal || $jml_tiket <= 0 || $harga_total <= 0 || !$id_wisata || !$id_customer) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak lengkap']);
        }

        $transaksi = Transaksi::create([
            'nama_customer' => $nama_customer,
            'tlp_costumer'  => $tlp_costumer,
            'tanggal_pesan' => date('Y-m-d', strtotime(str_replace('/', '-', $tanggal))),
            'jml_tiket'     => $jml_tiket,
            'harga_total'   => $harga_total,
            'id_wisata'     => $id_wisata,
            'id_customer'   => $id_customer,
        ]);

        RiwayatTransaksi::create([
            'id_customer'  => $id_customer,
            'id_pemesanan' => $transaksi->id_pemesanan,
            'tgl_pesanan'  => $transaksi->tanggal_pesan,
            'status'       => 'Selesai',
            'harga_total'  => $harga_total,
        ]);

        return response()->json([
            'status'       => 'success',
            'message'      => 'Transaksi & Riwayat berhasil disimpan',
            'id_pemesanan' => $transaksi->id_pemesanan,
        ]);
    }
}