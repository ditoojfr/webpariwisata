<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    // LOGIN MANUAL (Email & Password)[cite: 9]
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($email) || empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'Email dan password wajib diisi'], 400);
        }

        // Cari berdasarkan email_customer[cite: 9]
        $customer = Customer::where('email_customer', $email)->first();

        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Email tidak ditemukan'], 404);
        }

        $valid = Hash::check($password, $customer->password_customer)
            || $password === $customer->password_customer;

        if (!$valid) {
            return response()->json(['status' => 'error', 'message' => 'Password salah'], 401);
        }

        $token = $customer->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'status'         => 'success', // Pakai status agar konsisten dengan Flutter[cite: 8, 9]
            'message'        => 'Login berhasil',
            'token'          => $token,
            'data'           => [
                'id_customer'    => (string)$customer->id_customer,
                'nama_customer'  => $customer->nama_customer,
                'email'          => $customer->email_customer,
                'foto'           => $customer->foto ?? '',
            ]
        ]);
    }

    // GOOGLE LOGIN (Disinkronkan dengan nama kolom DB)[cite: 9]
    public function googleLogin(Request $request) {
        $email = $request->email;
        $nama  = $request->nama;
        $foto  = $request->foto;

        $user = Customer::where('email_customer', $email)->first();

        if (!$user) {
            $user = Customer::create([
                'nama_customer'     => $nama,
                'email_customer'    => $email, // Kolom DB lu email_customer[cite: 9]
                'foto'              => $foto,
                'password_customer' => Hash::make('password_google_default'), // Kolom DB lu password_customer[cite: 9]
                'tanggal_daftar'    => now(),
            ]);
            
            // Buat profil detail juga karena Trigger dihapus[cite: 9]
            $user->dataCustomer()->create([
                'nama_customer'     => $nama,
                'email_customer'    => $email,
                'password_customer' => Hash::make('password_google_default'),
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token'  => $token,
            'data'   => [
                'id_customer'   => $user->id_customer,
                'nama_customer' => $user->nama_customer,
                'email'         => $user->email_customer,
                'foto'          => $user->foto ?? '',
            ]
        ]);
    }

    // REGISTER MANUAL (Fix Undefined Variable)[cite: 9]
    public function register(Request $request)
    {
        // 1. Buat Akun Utama[cite: 9]
        $customer = Customer::create([
            'nama_customer'     => $request->nama,
            'email_customer'    => $request->email,
            'password_customer' => Hash::make($request->password),
            'tanggal_daftar'    => now(),
        ]);

        // 2. Buat Detail Profil (Karena Trigger dihapus)[cite: 9]
        $customer->dataCustomer()->create([
            'nama_customer'     => $request->nama,
            'email_customer'    => $request->email,
            'no_tlp'            => $request->no_tlp,
            'password_customer' => Hash::make($request->password),
        ]);

        $token = $customer->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'status' => 'success', // Ganti ke status agar seragam[cite: 9]
            'token'  => $token,
            'data'   => [
                'id_customer'   => $customer->id_customer, // Fix: dari $user ke $customer[cite: 9]
                'nama_customer' => $customer->nama_customer,
                'email'         => $customer->email_customer,
                'foto'          => $customer->foto ?? '',
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 'success', 'message' => 'Logout berhasil']);
    }
}