<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilApiController extends Controller
{
    // GET /api/profile (menggantikan get_profile.php)
    public function show(Request $request)
    {
        $id_customer = $request->query('id_customer') ?? $request->json('id_customer');

        if (!$id_customer) {
            return response()->json(['success' => false, 'message' => 'ID customer tidak boleh kosong']);
        }

        $profil = DataCustomer::where('id_customer', $id_customer)->first();

        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan']);
        }

        $fotoUrl = $profil->foto
            ? url('storage/profil/' . $profil->foto)
            : '';

        return response()->json([
            'success' => true,
            'message' => 'Profil ditemukan',
            'profile' => [
                'id_customer'    => $profil->id_customer,
                'nama_customer'  => $profil->nama_customer,
                'email_customer' => $profil->email_customer,
                'no_tlp'         => $profil->no_tlp,
                'foto'           => $fotoUrl,
            ],
        ]);
    }

    // PUT /api/profile (menggantikan updateProfile.php)
    public function update(Request $request)
    {
        $id_customer   = $request->post('id_customer');
        $nama_customer = trim($request->post('nama_customer', ''));
        $no_tlp        = trim($request->post('no_tlp', ''));

        if (!$id_customer || !$nama_customer) {
            return response()->json(['success' => false, 'message' => 'Data tidak lengkap']);
        }

        $profil = DataCustomer::where('id_customer', $id_customer)->first();
        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Customer tidak ditemukan']);
        }

        $foto = $profil->foto;

        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $namaFile);

            if ($foto && $foto !== 'default.jpg') {
                Storage::delete('public/profil/' . $foto);
            }
            $foto = $namaFile;
        }

        $profil->update([
            'nama_customer' => $nama_customer,
            'no_tlp'        => $no_tlp,
            'foto'          => $foto,
        ]);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui']);
    }
}