<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RiwayatController extends Controller
{
    // Halaman riwayat untuk customer (guest)
    public function index()
    {
        return view('riwayat');
    }

    // ✅ API: Ambil data riwayat berdasarkan pencarian email/no HP
    public function getCari(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            
            if (!$keyword) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keyword pencarian diperlukan'
                ], 400);
            }

            // Query ke tabel transaksi + join ke data_wisata
            $riwayat = DB::table('transaksi')
                ->leftJoin('data_wisata', 'transaksi.id_wisata', '=', 'data_wisata.id_wisata')
                ->where(function($query) use ($keyword) {
                    // Cari berdasarkan email ATAU telepon
                    $query->where('transaksi.email', 'LIKE', "%{$keyword}%")
                          ->orWhere('transaksi.tlp_costumer', 'LIKE', "%{$keyword}%");
                })
                ->select(
                    'transaksi.id_pemesanan',
                    'transaksi.nama_customer',
                    'transaksi.tlp_costumer',
                    'transaksi.email',
                    'transaksi.tanggal_pesan',
                    'transaksi.jml_tiket',
                    'transaksi.harga_total',
                    'transaksi.id_wisata',
                    'transaksi.id_customer',
                    'data_wisata.nama_wisata'
                )
                ->orderBy('transaksi.tanggal_pesan', 'desc')
                ->get();

            // Format data untuk frontend
            $data = $riwayat->map(function($item) {
                return [
                    'id' => $item->id_pemesanan,
                    'nomor' => '#NGJ-' . str_pad($item->id_pemesanan, 6, '0', STR_PAD_LEFT),
                    'wisata' => $item->nama_wisata ?? 'Wisata Tidak Ditemukan',
                    'nama' => $item->nama_customer,
                    'email' => $item->email ?? '-',
                    'telepon' => $item->tlp_costumer,
                    'tanggal' => $item->tanggal_pesan,
                    'jml_tiket' => $item->jml_tiket,
                    'total' => $item->harga_total,
                    'status' => 'Lunas',
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $data,
                'total' => count($data)
            ]);

        } catch (\Exception $e) {
            Log::error('Error getCari: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data: ' . $e->getMessage()
            ], 500);
        }
    }

    // ✅ API: Hapus transaksi (opsional)
    public function hapus(Request $request)
    {
        try {
            $id = $request->input('id');
            
            // Hapus berdasarkan id_pemesanan
            DB::table('transaksi')->where('id_pemesanan', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            Log::error('Error hapus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage()
            ], 500);
        }
    }
}