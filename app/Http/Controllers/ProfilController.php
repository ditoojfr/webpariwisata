<?php

namespace App\Http\Controllers;

use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // Tampilkan halaman profil user
    public function show()
    {
        $user_id = session('user_id');
        $data = DataCustomer::where('id_customer', $user_id)->first();

        if (!$data) {
            session()->flush();
            return redirect('/login')->with('error', 'Profil belum lengkap.');
        }

        return view('profil', compact('data'));
    }

    // Update profil user
    public function update(Request $request)
    {
        $user_id = session('user_id');

        $request->validate([
            'name'   => 'required|string|max:255',
            'no_tlp' => 'required|string|max:20',
        ]);

        $dataCustomer = DataCustomer::where('id_customer', $user_id)->first();
        $foto_baru = $dataCustomer->foto ?? 'default.jpg';

        // Handle upload foto profil
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');

            $request->validate([
                'foto_profil' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            $namaFile = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $namaFile);

            // Hapus foto lama
            if ($foto_baru !== 'default.jpg') {
                Storage::delete('public/profil/' . $foto_baru);
            }
            $foto_baru = $namaFile;
        }

        DataCustomer::where('id_customer', $user_id)->update([
            'nama_customer' => $request->name,
            'no_tlp'        => $request->no_tlp,
            'foto'          => $foto_baru,
        ]);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
    }

    // Profil admin
    public function adminShow()
    {
        return view('admin.profil');
    }
}