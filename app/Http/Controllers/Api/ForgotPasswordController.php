<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer; // Sesuaikan dengan nama model user/customer lu
use App\Mail\ResetPasswordOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function forgotPassword(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email'
        ]);

        // 2. Cek apakah email terdaftar di tabel customer lu
        $user = Customer::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak terdaftar di sistem kami.'
            ], 404);
        }

        // 3. Generate kode OTP 6 Digit angka acak
        $otp = rand(100000, 999999);

        // 4. Simpan/Timpa OTP ke database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $otp,
                'created_at' => now()
            ]
        );

        // 5. Kirim Emailnya!
        try {
            Mail::to($request->email)->send(new ResetPasswordOtpMail($otp));
            
            return response()->json([
                'status' => 'success',
                'message' => 'Kode OTP berhasil dikirim ke email Anda!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim email. Pastikan koneksi internet stabil. Error: ' . $e->getMessage()
            ], 500);
        }
    }
}