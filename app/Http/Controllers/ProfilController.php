<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    // ==================== USER PROFILE ====================
    
    public function show()
    {
        $user_id = session('user_id');
        $data = DB::table('data_customer')->where('id_customer', $user_id)->first();

        if (!$data) {
            session()->flush();
            return redirect('/login')->with('error', 'Profil belum lengkap.');
        }

        return view('profil', compact('data'));
    }

    public function update(Request $request)
    {
        $user_id = session('user_id');

        $request->validate([
            'name'   => 'required|string|max:255',
            'no_tlp' => 'required|string|max:20',
        ]);

        $dataCustomer = DB::table('data_customer')->where('id_customer', $user_id)->first();
        $foto_baru = $dataCustomer->foto ?? 'default.jpg';

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $request->validate([
                'foto_profil' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            $namaFile = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $namaFile);

            if ($foto_baru !== 'default.jpg') {
                Storage::delete('public/profil/' . $foto_baru);
            }
            $foto_baru = $namaFile;
        }

        DB::table('data_customer')->where('id_customer', $user_id)->update([
            'nama_customer' => $request->name,
            'no_tlp'        => $request->no_tlp,
            'foto'          => $foto_baru,
        ]);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
    }

    // ==================== ADMIN PROFILE ====================

    public function adminShow()
    {
        $admin_id = session('user_id');
        
        if (!$admin_id) {
            return redirect()->route('admin.login')->with('error', 'Silakan login.');
        }
        
        $admin = DB::table('data_admin')
            ->where('id_admin', $admin_id)
            ->first();
        
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Data admin tidak ditemukan.');
        }
        
        $user = (object) [
            'id'             => $admin->id_admin,
            'name'           => $admin->nama_admin,
            'email'          => $admin->email,
            'no_tlp'         => $admin->no_tlp ?? '',
            'telepon'        => $admin->no_tlp ?? '',
            'foto'           => $admin->foto ?? '',
            'foto_profile'   => $admin->foto ?? '',
        ];
        
        return view('admin.profil', compact('user'));
    }

   public function adminUpdate(Request $request)
{
    $admin_id = session('user_id');
    
    if (!$admin_id) {
        return redirect()->route('admin.login')->with('error', 'Session expired.');
    }

    $admin = DB::table('data_admin')->where('id_admin', $admin_id)->first();
    
    if (!$admin) {
        return redirect()->back()->with('error', 'Data admin tidak ditemukan.');
    }

    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',  // Tetap validasi tapi tidak diupdate
        'email' => 'required|email|max:255',
        'no_tlp' => 'nullable|string|max:20',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $foto_baru = $admin->foto ?? '';

    // Handle upload foto
    if ($request->hasFile('foto')) {
        if ($foto_baru && $foto_baru !== 'default.jpg' && Storage::disk('public')->exists($foto_baru)) {
            Storage::disk('public')->delete($foto_baru);
        }
        
        $fotoPath = $request->file('foto')->store('profil', 'public');
        $foto_baru = $fotoPath;
    }

    // ✅ HANYA update email, no_tlp, dan foto (JANGAN update nama_admin)
    DB::table('data_admin')
        ->where('id_admin', $admin_id)
        ->update([
            'email' => $request->email,
            'no_tlp' => $request->no_tlp ?? $admin->no_tlp,
            'foto' => $foto_baru,
        ]);

    // Update session (nama tetap dari database, tidak berubah)
    session([
        'user_name' => $admin->nama_admin,  // Tetap pakai nama lama
        'user_email' => $request->email,
    ]);

    return redirect()->back()->with('success', ' Profil admin berhasil diperbarui!');
}
}