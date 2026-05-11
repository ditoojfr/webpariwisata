<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataApiController extends Controller
{
    // GET /api/wisata
    public function index()
    {
        try {
            $wisata = Wisata::all()->map(function ($item) {
                return [
                    // Gunakan ?? fallback dan casting (int) biar Flutter gak rewel
                    'id_wisata'      => $item->id_wisata ?? $item->id ?? 0,
                    'nama_wisata'    => $item->nama_wisata ?? '-',
                    'lokasi'         => $item->lokasi ?? '-',
                    'tiket_dewasa'   => (int) ($item->tiket_dewasa ?? 0),
                    'tiket_anak'     => (int) ($item->tiket_anak ?? 0),
                    'biaya_asuransi' => (int) ($item->biaya_asuransi ?? 0),
                    'fasilitas'      => $item->fasilitas ?? '-',
                    'deskripsi'      => $item->deskripsi ?? '-',
                    'gambar'         => !empty($item->gambar) ? url('images/destinasi/' . $item->gambar) : null,
                ];
            });

            // Kasih tau Flutter kalau datanya emang beneran kosong di DB
            if ($wisata->isEmpty()) {
                return response()->json([
                    'status'  => 'error', 
                    'message' => 'Data wisata masih kosong di database'
                ], 404);
            }

            return response()->json([
                'status' => 'success', 
                'data'   => $wisata
            ], 200);

        } catch (\Throwable $e) {
            // Tangkap error fatal biar server gak banting pintu (Connection closed)
            error_log("CRASH DI API WISATA INDEX: " . $e->getMessage() . " di baris " . $e->getLine());
            
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    // GET /api/wisata/{id}
    public function show($id)
    {
        try {
            // 1. Ambil data wisata beserta galeri DAN ulasan (beserta data customernya)
            $wisata = Wisata::with(['galeri', 'ulasan.customer'])->find($id);

            if (!$wisata) {
                return response()->json([
                    'status'  => 'error', 
                    'message' => 'Wisata tidak ditemukan'
                ], 404);
            }

            // 2. Format URL gambar utama wisata
            $wisata->gambar = !empty($wisata->gambar) ? url('images/destinasi/' . $wisata->gambar) : null;

            // 3. Format URL gambar di dalam galeri dengan pengaman relasi
            if ($wisata->relationLoaded('galeri') && $wisata->galeri) {
                $wisata->galeri->transform(function ($item) {
                    $item->gambar_poster = !empty($item->gambar_poster) 
                        ? url('images/destinasi/' . $item->gambar_poster) 
                        : null;
                    return $item;
                });
            }

            // 4. Format URL foto profil customer di dalam ulasan dengan pengaman
            if ($wisata->relationLoaded('ulasan') && $wisata->ulasan) {
                $wisata->ulasan->transform(function ($item) {
                    if ($item->customer) {
                        $item->customer->foto = !empty($item->customer->foto) 
                            ? url('storage/profil/' . $item->customer->foto) 
                            : null;
                    }
                    return $item;
                });
            }

            return response()->json([
                'status' => 'success', 
                'data'   => $wisata
            ], 200);

        } catch (\Throwable $e) {
            error_log("CRASH DI API WISATA SHOW: " . $e->getMessage() . " di baris " . $e->getLine());

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
}