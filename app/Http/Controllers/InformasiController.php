<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function harga()
    {
        return view('informasi.harga');
    }

    public function pesan()
    {
        return view('informasi.pesan');
    }
}