<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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
        
        // GANTI PAKAI MOVE (Biar sama kayak Admin)
       $tujuanUpload = public_path('profil');
        $file->move($tujuanUpload, $namaFile);

        // HAPUS FOTO LAMA PAKAI UNLINK
        if ($foto_baru !== 'default.jpg') {
            $fotoLamaPath = $tujuanUpload . '/' . $foto_baru;
            if (file_exists($fotoLamaPath)) {
                unlink($fotoLamaPath);
            }
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

    // 1. Validasi Dasar (Termasuk form nama kalau lu pakai Opsi 1 kemarin)
    $rules = [
        'nama'   => 'required|string|max:255',
        'email'  => 'required|email|max:255',
        'no_tlp' => 'nullable|string|max:15|regex:/^[0-9]+$/',
        'foto'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ];

    // 2. Validasi: jika SALAH SATU field password diisi, keduanya wajib diisi
if ($request->filled('password_lama') || $request->filled('password_baru')) {
    $rules['password_lama'] = 'required|string';
    $rules['password_baru'] = 'required|string|min:6|different:password_lama'; // ← different: cegah password sama
}

    $request->validate($rules);

// 3. Cek password lama ke database
$hashedPasswordBaru = null;
if ($request->filled('password_lama') || $request->filled('password_baru')) {

    // Cek password lama benar atau tidak
    if (!Hash::check($request->password_lama, $admin->password)) {
        return redirect()->back()
            ->with('error', '❌ Password lama yang Anda masukkan salah!')
            ->withInput(['nama' => $request->nama, 'email' => $request->email, 'no_tlp' => $request->no_tlp]);
    }

    $hashedPasswordBaru = Hash::make($request->password_baru);
}

    // 4. Handle upload foto Admin
    $foto_baru = $admin->foto ?? '';
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $namaFile = 'admin_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        $tujuanUpload = public_path('profil_admin');
        $file->move($tujuanUpload, $namaFile);
        
        if ($foto_baru && $foto_baru !== 'default.jpg') {
            $fotoLamaPath = $tujuanUpload . '/' . $foto_baru;
            if (file_exists($fotoLamaPath)) {
                unlink($fotoLamaPath);
            }
        }
        
        $foto_baru = $namaFile;
    }

    // 5. Susun array data untuk diupdate
    $dataUpdate = [
        'nama_admin' => $request->nama, // Ubah jika nama boleh diedit
        'email'      => $request->email,
        'no_tlp'     => $request->no_tlp ?? $admin->no_tlp,
        'foto'       => $foto_baru,
    ];

    // Jika ada password baru yang tervalidasi, masukkan ke array update
    if ($hashedPasswordBaru) {
        $dataUpdate['password'] = $hashedPasswordBaru;
    }

    // Eksekusi Update ke Database
    DB::table('data_admin')
        ->where('id_admin', $admin_id)
        ->update($dataUpdate);

    // Update Session
    session([
        'user_name'  => $request->nama,
        'user_email' => $request->email,
    ]);

    return redirect()->back()->with('success', 'Profil admin berhasil diperbarui!');
}
}