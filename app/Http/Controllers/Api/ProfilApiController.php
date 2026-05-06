<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataCustomer; // Sesuaikan kalau nama model lu Customer
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfilApiController extends Controller
{
    // POST /api/profile/update (Bisa buat Update Text & Upload Foto)[cite: 6, 7]
    // POST /api/profile/update
    public function update(Request $request)
    {
        // 1. Ganti 'post' jadi 'input' biar lebih ampuh nangkep data dari Flutter
        $id_customer    = $request->input('id_customer');
        $nama_customer  = $request->input('nama_customer');
        $email_customer = $request->input('email_customer');
        $password       = $request->input('password');

        // Bersihkan ID dari spasi ga sengaja
        $id_customer = trim($id_customer);

        if (!$id_customer) {
            return response()->json(['status' => 'error', 'message' => 'ID tidak ditemukan.']);
        }

        // Cari berdasarkan kolom id_customer
        $profil = DataCustomer::where('id_customer', $id_customer)->first();
        
        if (!$profil) {
            // Ini biar lu tau di layar HP, ID berapa sih yang ditangkep Laravel!
            return response()->json(['status' => 'error', 'message' => 'Customer gagal ditemukan untuk ID: [' . $id_customer . ']']);
        }

        // 1. UPDATE FOTO 
        $foto = $profil->foto;
        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $namaFile); 

            if ($foto && $foto !== 'default.jpg' && $foto !== '') {
                Storage::delete('public/profil/' . $foto);
            }
            $foto = $namaFile;
            
            if (!$nama_customer && !$email_customer) {
                $profil->update(['foto' => $foto]);
                return response()->json(['status' => 'success', 'message' => 'Foto diupdate', 'foto' => $foto]);
            }
        }

        // 2. UPDATE TEXT (Ganti ke nama kolom yang bener)
        $dataUpdate = [
            'nama_customer'  => $nama_customer ?? $profil->nama_customer,
            'email_customer' => $email_customer ?? $profil->email_customer, // <-- DISESUAIKAN SAMA DB LU
            'foto'           => $foto
        ];

        // 3. UPDATE PASSWORD (Ganti ke kolom password_customer)
        if (!empty($password)) {
            $dataUpdate['password_customer'] = Hash::make($password); // <-- DISESUAIKAN SAMA DB LU
        }

        $profil->update($dataUpdate);

        return response()->json(['status' => 'success', 'message' => 'Profil berhasil diperbarui']);
    }

    // POST /api/profile/hapus-foto
    public function deleteFoto(Request $request)
    {
        $id_customer = $request->post('id_customer');
        $profil = DataCustomer::where('id_customer', $id_customer)->first();

        if ($profil && $profil->foto) {
            Storage::delete('public/profil/' . $profil->foto);
            $profil->update(['foto' => '']); // Kosongin nama foto di DB
            return response()->json(['status' => 'success', 'message' => 'Foto dihapus']);
        }

        return response()->json(['status' => 'error', 'message' => 'Gagal hapus foto']);
    }
}