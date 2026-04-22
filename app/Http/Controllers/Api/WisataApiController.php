<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;

class WisataApiController extends Controller
{
    // GET /api/wisata (menggantikan get_all_wisata.php)
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
                'gambar'         => $item->gambar,
            ];
        });

        return response()->json(['status' => 'success', 'data' => $wisata]);
    }

    // GET /api/wisata/{id} (menggantikan get_detail_wisata.php)
    public function show($id)
    {
        $wisata = Wisata::find($id);

        if (!$wisata) {
            return response()->json(['status' => 'error', 'message' => 'Wisata tidak ditemukan'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $wisata]);
    }
}