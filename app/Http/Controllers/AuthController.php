<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login admin
    public function showLogin()
    {
        // Kalau sudah login sebagai admin, langsung ke panel admin
        if (session('role') === 'admin') {
            return redirect('/admin/beranda');
        }
        return view('auth.login');
    }

    // Proses login admin — selalu return JSON
    public function login(Request $request)
    {
        $email    = trim($request->input('email', ''));
        $password = $request->input('password', '');

        if (empty($email) || empty($password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email dan kata sandi wajib diisi.',
            ]);
        }

        // Cari admin berdasarkan email di tabel data_admin
        $admin = DB::table('data_admin')
            ->where('email', $email)
            ->first();

        // Jika kolom email tidak ada, coba cari berdasarkan nama_admin
        if (!$admin) {
            $admin = DB::table('data_admin')
                ->where('nama_admin', $email)
                ->first();
        }

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau nama admin tidak ditemukan.',
            ]);
        }

        // Dukung plain text lama DAN bcrypt baru
        $passwordField = $admin->password ?? $admin->password_admin ?? '';
        $valid = Hash::check($password, $passwordField) || $password === $passwordField;

        if (!$valid) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah.',
            ]);
        }

        // Set session admin
        session([
            'role'       => 'admin',
            'user_id'    => $admin->id_admin ?? $admin->id ?? 0,
            'user_name'  => $admin->nama_admin ?? $admin->name ?? 'Admin',
            'user_email' => $admin->email ?? $email,
        ]);

        return response()->json([
            'success'  => true,
            'redirect' => '/admin/beranda',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/beranda');
    }
}
