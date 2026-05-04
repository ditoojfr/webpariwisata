<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        Log::info('=== TRANSAKSI STORE DIPANGGIL ===');
        Log::info('Data:', $request->all());

        try {
            // Validasi
            $validated = $request->validate([
                'nama_customer' => 'required|string|max:255',
                'tlp_customer'  => 'required|string|max:20',
                'tanggal_pesan' => 'required|date',
                'jml_tiket'     => 'required|integer|min:1',
                'harga_total'   => 'required|numeric|min:1000',
                'id_wisata'     => 'required|exists:data_wisata,id_wisata',
                'id_customer'   => 'nullable|exists:akun_customer,id_customer',
            ]);

            DB::beginTransaction();

            // Siapkan data HANYA untuk kolom yang ADA
            $insertData = [
                'nama_customer' => $validated['nama_customer'],
                'tlp_costumer'  => $validated['tlp_customer'], // Sesuai typo di DB
                'tanggal_pesan' => $validated['tanggal_pesan'],
                'jml_tiket'     => $validated['jml_tiket'],
                'harga_total'   => $validated['harga_total'],
                'id_wisata'     => $validated['id_wisata'],
                'id_customer'   => $validated['id_customer'] ?? null,
            ];

            Log::info('Data yang akan diinsert:', $insertData);

            // INSERT ke tabel transaksi
            DB::table('transaksi')->insert($insertData);

            DB::commit();

            Log::info('✅ BERHASIL! Data tersimpan.');

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil!'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('❌ ERROR: ' . $e->getMessage());
            Log::error('Line: ' . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}