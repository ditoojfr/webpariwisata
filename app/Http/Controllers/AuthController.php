<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; // Pastikan model Customer lu bener namanya
use App\Mail\ResetPasswordOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. FUNGSI KIRIM EMAIL OTP
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // CARI 'email_customer'
        $user = Customer::where('email_customer', $request->email)->first();
        
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Email tidak terdaftar.'], 404);
        }

        $otp = rand(10000, 99999);

        // Simpan ke password_reset_tokens (kolomnya emang 'email' di sini)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $otp, 'created_at' => now()]
        );

        try {
            Mail::to($request->email)->send(new ResetPasswordOtpMail($otp));
            return response()->json(['status' => 'success', 'message' => 'Kode OTP terkirim!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal ngirim email: ' . $e->getMessage()], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        // 1. Hapus 'otp' dari validasi karena sudah divalidasi sebelumnya
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6' 
        ]);

        // 2. Update password langsung
        $customer = Customer::where('email_customer', $request->email)->first();
        
        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Email tidak ditemukan.'], 404);
        }

        $customer->update([
            'password_customer' => bcrypt($request->password) 
        ]);

        // 3. Hapus token OTP di database biar nggak disalahgunakan
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['status' => 'success', 'message' => 'Password berhasil diubah!']);
    }

    // 2. FUNGSI CEK OTP
    public function verifyOtp(Request $request)
    {
        // 1. Hapus return debug yang memblokir kode di bawahnya
        
        // 2. Langsung validasi request
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|numeric'
        ]);

        // 3. Cek ke tabel password_reset_tokens
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        // 4. Jika tidak ada yang cocok
        if (!$resetData) {
            return response()->json(['status' => 'error', 'message' => 'Kode OTP salah.'], 400);
        }

        // 5. Cek kadaluarsa (15 menit)
        $createdAt = \Carbon\Carbon::parse($resetData->created_at);
        if (now()->diffInMinutes($createdAt) > 15) {
            return response()->json(['status' => 'error', 'message' => 'Kode OTP kadaluarsa.'], 400);
        }

        // 6. Jika semua aman, kembalikan status success
        return response()->json([
            'status' => 'success',
            'message' => 'OTP berhasil diverifikasi'
        ], 200);
    }



    // Tampilkan halaman login admin
    public function showLogin()
{
    if (session('role') === 'admin') {
        // Gunakan redirect()->to() bukan redirect() biasa
        session()->save(); // paksa session tersimpan sebelum redirect
return redirect()->to('/admin/beranda');
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
        // Ambil password dari kolom yang benar
        $passwordField = $admin->password ?? '';

        // Cek password: dukung plain text DULU, baru bcrypt
        $valid = ($password === $passwordField)
            || (strlen($passwordField) > 0 && Hash::check($password, $passwordField));

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
            'redirect' => url('/admin/beranda'),
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/beranda');
    }
}