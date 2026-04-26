<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // POST /transaksi — bisa diakses tanpa login
    public function store(Request $request)
    {
        $nama_customer = trim($request->input('nama_customer', ''));
        $tlp_customer  = trim($request->input('tlp_customer', ''));
        $tanggal_pesan = $request->input('tanggal_pesan', '');
        $jml_tiket     = (int) $request->input('jml_tiket', 0);
        $harga_total   = (int) $request->input('harga_total', 0);
        $id_wisata     = (int) $request->input('id_wisata', 0);
        // id_customer = 0 karena tidak pakai akun user lagi
        $id_customer   = (int) $request->input('id_customer', 0);

        if (!$nama_customer || !$tlp_customer || !$tanggal_pesan || $jml_tiket <= 0 || $harga_total <= 0 || !$id_wisata) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemesanan tidak lengkap.',
            ]);
        }

        // Simpan ke tabel transaksi
        $transaksi = Transaksi::create([
            'nama_customer' => $nama_customer,
            'tlp_costumer'  => $tlp_customer,
            'tanggal_pesan' => $tanggal_pesan,
            'jml_tiket'     => $jml_tiket,
            'harga_total'   => $harga_total,
            'id_wisata'     => $id_wisata,
            'id_customer'   => $id_customer,
        ]);

        // Simpan ke riwayat_transaksi
        RiwayatTransaksi::create([
            'id_customer'  => $id_customer,
            'id_pemesanan' => $transaksi->id_pemesanan,
            'tgl_pesanan'  => $tanggal_pesan,
            'status'       => 'Selesai',
            'harga_total'  => $harga_total,
        ]);

        return response()->json([
            'success'      => true,
            'message'      => 'Pemesanan berhasil disimpan.',
            'id_pemesanan' => $transaksi->id_pemesanan,
        ]);
    }
}
