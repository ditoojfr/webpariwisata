<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string',
            'tlp_customer'  => 'required|string',
            'tanggal_pesan' => 'required|date',
            'jml_tiket'     => 'required|integer|min:1',
            'harga_total'   => 'required|integer|min:1',
            'id_wisata'     => 'required|integer',
            'id_customer'   => 'required|integer',
        ]);

        // Simpan ke tabel transaksi
        $transaksi = Transaksi::create([
            'nama_customer' => $request->nama_customer,
            'tlp_costumer'  => $request->tlp_customer,  // typo ikut nama kolom DB
            'tanggal_pesan' => $request->tanggal_pesan,
            'jml_tiket'     => $request->jml_tiket,
            'harga_total'   => $request->harga_total,
            'id_wisata'     => $request->id_wisata,
            'id_customer'   => $request->id_customer,
        ]);

        // Simpan ke riwayat_transaksi
        RiwayatTransaksi::create([
            'id_customer'  => $request->id_customer,
            'id_pemesanan' => $transaksi->id_pemesanan,
            'tgl_pesanan'  => $request->tanggal_pesan,
            'status'       => 'Selesai',
            'harga_total'  => $request->harga_total,
        ]);

        return response()->json([
            'success'      => true,
            'message'      => 'Transaksi dan riwayat berhasil disimpan',
            'id_pemesanan' => $transaksi->id_pemesanan,
            'jml_tiket'    => $transaksi->jml_tiket,
            'harga_total'  => $transaksi->harga_total,
        ]);
    }
}