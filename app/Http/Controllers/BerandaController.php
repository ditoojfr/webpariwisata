<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $destinasi = Wisata::orderBy('id_wisata', 'asc')->get();

        // Siapkan data dalam format array sederhana agar mudah dibaca di Blade
        $wisataJson = $destinasi->map(function($d) {
            return [
                'id'             => $d->id_wisata,
                'title'          => $d->nama_wisata,
                'lokasi'         => $d->lokasi,
                'foto'           => asset('storage/destinasi/' . $d->gambar),
                'harga_dewasa'   => (int)$d->tiket_dewasa,
                'harga_anak'     => (int)$d->tiket_anak,
                'harga_asuransi' => (int)($d->biaya_asuransi ?? 500),
                'deskripsi'      => $d->deskripsi ?? '',
                'fasilitas'      => $d->fasilitas ?? '',
            ];
        })->keyBy('id')->toArray();

        return view('beranda', compact('destinasi', 'wisataJson'));
    }
}