<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $destinasi = Wisata::orderBy('id_wisata', 'asc')->get();
        return view('beranda', compact('destinasi'));
    }
}