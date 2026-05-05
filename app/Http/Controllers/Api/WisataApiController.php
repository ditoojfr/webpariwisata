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
        $wisata = Wisata::all()->map(function ($item) {
            return [
                'id_wisata'      => $item->id_wisata,
                'nama_wisata'    => $item->nama_wisata,
                'lokasi'         => $item->lokasi,
                'tiket_dewasa'   => $item->tiket_dewasa,
                'tiket_anak'     => $item->tiket_anak,
                'biaya_asuransi' => $item->biaya_asuransi,
                'fasilitas'      => $item->fasilitas,
                'deskripsi'      => $item->deskripsi,
                'gambar'         => $item->gambar ? url('images/destinasi/' . $item->gambar) : null,
            ];
        });

        return response()->json(['status' => 'success', 'data' => $wisata]);
    }

    // GET /api/wisata/{id}
    public function show($id)
    {
        // 1. Ambil data wisata beserta galeri DAN ulasan (beserta data customernya)
        $wisata = Wisata::with(['galeri', 'ulasan.customer'])->find($id);

        if (!$wisata) {
            return response()->json(['status' => 'error', 'message' => 'Wisata tidak ditemukan'], 404);
        }

        // 2. Format URL gambar utama wisata
        $wisata->gambar = $wisata->gambar ? url('images/destinasi/' . $wisata->gambar) : null;

        // 3. Format URL gambar di dalam galeri (event)[cite: 4]
        $wisata->galeri->transform(function ($item) {
            $item->gambar_poster = $item->gambar_poster ? url('images/destinasi/' . $item->gambar_poster) : null;
            return $item;
        });

        // 4. Format URL foto profil customer di dalam ulasan biar muncul di Flutter
        $wisata->ulasan->transform(function ($item) {
            if ($item->customer) {
                $item->customer->foto = $item->customer->foto 
                    ? url('storage/profil/' . $item->customer->foto) 
                    : null;
            }
            return $item;
        });

        return response()->json([
            'status' => 'success', 
            'data'   => $wisata
        ]);
    }
}