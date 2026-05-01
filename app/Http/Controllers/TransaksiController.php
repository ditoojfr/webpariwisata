<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    /**
     * POST /transaksi
     * Menyimpan pemesanan tiket wisata (bisa diakses tanpa login)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Cek apakah request berupa JSON
        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            $data = $request->all();
        }

        // Ambil dan sanitasi data
        $nama_customer = trim($data['nama_customer'] ?? '');
        $tlp_customer  = trim($data['tlp_customer'] ?? '');
        $email         = trim($data['email'] ?? '');
        $tanggal_pesan = $data['tanggal_pesan'] ?? '';
        $jml_tiket     = (int) ($data['jml_tiket'] ?? 0);
        $harga_total   = (int) ($data['harga_total'] ?? 0);
        $id_wisata     = (int) ($data['id_wisata'] ?? 0);
        
        // id_customer: null untuk guest, integer jika ada user login
        $id_customer   = isset($data['id_customer']) && $data['id_customer'] !== null && $data['id_customer'] !== ''
            ? (int) $data['id_customer']
            : null;

        // Validasi data yang wajib diisi
        if (!$nama_customer || !$tlp_customer || !$tanggal_pesan || $jml_tiket <= 0 || $harga_total <= 0 || !$id_wisata) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemesanan tidak lengkap. Mohon lengkapi semua field yang wajib diisi.',
            ], 422);
        }

        // Validasi format email jika ada
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'message' => 'Format email tidak valid.',
            ], 422);
        }

        try {
            // Mulai database transaction
            DB::beginTransaction();

            // Simpan data ke tabel transaksi
            $transaksi = Transaksi::create([
                'nama_customer' => $nama_customer,
                'tlp_costumer'  => $tlp_customer,  // Sesuai nama kolom di database (typo)
                'email'         => $email,          // Kolom email
                'tanggal_pesan' => $tanggal_pesan,
                'jml_tiket'     => $jml_tiket,
                'harga_total'   => $harga_total,
                'id_wisata'     => $id_wisata,
                'id_customer'   => $id_customer,    // Bisa NULL untuk guest
            ]);

            // Simpan ke tabel riwayat_transaksi (jika model ada)
            if (class_exists('App\Models\RiwayatTransaksi')) {
                RiwayatTransaksi::create([
                    'id_customer'  => $id_customer,
                    'id_pemesanan' => $transaksi->id_pemesanan,
                    'tgl_pesanan'  => $tanggal_pesan,
                    'status'       => 'Lunas',  // Status default
                    'harga_total'  => $harga_total,
                ]);
            }

            // Commit transaction
            DB::commit();

            // Log berhasil (opsional)
            Log::info('Transaksi berhasil disimpan', [
                'id_pemesanan' => $transaksi->id_pemesanan,
                'nama' => $nama_customer,
                'total' => $harga_total
            ]);

            // Return response sukses
            return response()->json([
                'success'      => true,
                'message'      => 'Pemesanan berhasil disimpan.',
                'id_pemesanan' => $transaksi->id_pemesanan,
            ], 201);

        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error menyimpan transaksi: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'data' => $data
            ]);

            // Return response error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
}