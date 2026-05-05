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
    public function update(Request $request)
    {
        $id_customer   = $request->post('id_customer');
        $nama_customer = $request->post('nama_customer');
        $email_customer = $request->post('email_customer');
        $password = $request->post('password');

        if (!$id_customer) {
            return response()->json(['status' => 'error', 'message' => 'ID tidak ditemukan']);
        }

        $profil = DataCustomer::where('id_customer', $id_customer)->first();
        if (!$profil) {
            return response()->json(['status' => 'error', 'message' => 'Customer tidak ditemukan']);
        }

        // 1. UPDATE FOTO (Kalau ada file yang dikirim)[cite: 6, 7]
        $foto = $profil->foto;
        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $namaFile); // Kesimpen di storage/app/public/profil

            if ($foto && $foto !== 'default.jpg' && $foto !== '') {
                Storage::delete('public/profil/' . $foto);
            }
            $foto = $namaFile;
            
            // Kalau cuma update foto, langsung return biar gampang dibaca Flutter
            if (!$nama_customer && !$email_customer) {
                $profil->update(['foto' => $foto]);
                return response()->json(['status' => 'success', 'message' => 'Foto diupdate', 'foto' => $foto]);
            }
        }

        // 2. UPDATE TEXT (Nama, Email, Password)[cite: 6, 7]
        $dataUpdate = [
            'nama_customer' => $nama_customer ?? $profil->nama_customer,
            'email' => $email_customer ?? $profil->email, // Sesuaikan kalau di DB lu namanya email_customer
            'foto' => $foto
        ];

        // Cuma ganti password kalau formnya diisi
        if (!empty($password)) {
            $dataUpdate['password'] = Hash::make($password);
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