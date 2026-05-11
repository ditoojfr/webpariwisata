<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    // LOGIN MANUAL (Email & Password)
    public function login(Request $request)
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');

            if (empty($email) || empty($password)) {
                return response()->json(['status' => 'error', 'message' => 'Email dan password wajib diisi'], 400);
            }

            // 1. CARI CUSTOMER + TARIK DATA PROFILNYA SEKALIAN (Eager Loading)
            $customer = Customer::with('dataCustomer')->where('email_customer', $email)->first();

            if (!$customer) {
                return response()->json(['status' => 'error', 'message' => 'Email tidak ditemukan'], 404);
            }

            $valid = Hash::check($password, $customer->password_customer)
                || $password === $customer->password_customer;

            if (!$valid) {
                return response()->json(['status' => 'error', 'message' => 'Password salah'], 401);
            }

            $token = $customer->createToken('mobile-app')->plainTextToken;

            // Cari bagian ini di AuthApiController.php (fungsi login)
            $namaFoto = $customer->dataCustomer->foto ?? $customer->foto ?? null;

            $urlFoto = '';
            if (!empty($namaFoto)) {
                // LANGSUNG TEMBAK KE FOLDER public/profil
                $urlFoto = str_starts_with($namaFoto, 'http') ? $namaFoto : url('profil/' . $namaFoto);
            }
            
            return response()->json([
                'status'         => 'success', 
                'message'        => 'Login berhasil',
                'token'          => $token,
                'data'           => [   
                    'id_customer'    => (string)$customer->id_customer,
                    'nama_customer'  => $customer->nama_customer ?? '-',
                    'email'          => $customer->email_customer ?? '-',
                    'foto'           => $urlFoto, // <--- SEKARANG MENGIRIM FULL URL
                ]
            ], 200);

        } catch (\Throwable $e) {
            error_log("CRASH DI API LOGIN: " . $e->getMessage() . " di baris " . $e->getLine());

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan internal server: ' . $e->getMessage()
            ], 500);
        }
    }

    // GOOGLE LOGIN 
    public function googleLogin(Request $request) 
    {
        try {
            $email = $request->email;
            $nama  = $request->nama;
            $foto  = $request->foto; // Biasanya sudah berupa URL lengkap dari Google

            $user = Customer::with('dataCustomer')->where('email_customer', $email)->first();

            if (!$user) {
                $user = Customer::create([
                    'nama_customer'     => $nama,
                    'email_customer'    => $email, 
                    'foto'              => $foto,
                    'password_customer' => Hash::make('password_google_default'), 
                    'tanggal_daftar'    => now(),
                ]);
                
                $user->dataCustomer()->create([
                    'nama_customer'     => $nama,
                    'email_customer'    => $email,
                    'foto'              => $foto,
                    'password_customer' => Hash::make('password_google_default'),
                ]);

                // Muat ulang relasi setelah dibuat
                $user->load('dataCustomer');
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            $namaFoto = $user->dataCustomer->foto ?? $user->foto ?? null;
            $urlFoto = '';
            if (!empty($namaFoto)) {
                $urlFoto = str_starts_with($namaFoto, 'http') ? $namaFoto : url('storage/profil/' . $namaFoto);
            }

            return response()->json([
                'status' => 'success',
                'token'  => $token,
                'data'   => [
                    'id_customer'   => (string)$user->id_customer,  
                    'nama_customer' => $user->nama_customer ?? '-',
                    'email'         => $user->email_customer ?? '-',
                    'foto'          => $urlFoto,
                ]
            ], 200);

        } catch (\Throwable $e) {
            error_log("CRASH DI API GOOGLE LOGIN: " . $e->getMessage() . " di baris " . $e->getLine());

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan internal server: ' . $e->getMessage()
            ], 500);
        }
    }

    // REGISTER MANUAL 
    public function register(Request $request)
    {
        try {
            $customer = Customer::create([
                'nama_customer'     => $request->nama,
                'email_customer'    => $request->email,
                'password_customer' => Hash::make($request->password),
                'tanggal_daftar'    => now(),
            ]);

            $customer->dataCustomer()->create([
                'nama_customer'     => $request->nama,
                'email_customer'    => $request->email,
                'no_tlp'            => $request->no_tlp,
                'password_customer' => Hash::make($request->password),
            ]);

            $customer->load('dataCustomer');

            $token = $customer->createToken('mobile-app')->plainTextToken;

            $namaFoto = $customer->dataCustomer->foto ?? $customer->foto ?? null;
            $urlFoto = '';
            if (!empty($namaFoto)) {
                $urlFoto = str_starts_with($namaFoto, 'http') ? $namaFoto : url('storage/profil/' . $namaFoto);
            }

            return response()->json([
                'status' => 'success', 
                'token'  => $token,
                'data'   => [
                    'id_customer'   => (string)$customer->id_customer, 
                    'nama_customer' => $customer->nama_customer ?? '-',
                    'email'         => $customer->email_customer ?? '-',
                    'foto'          => $urlFoto,
                ]
            ], 200);

        } catch (\Throwable $e) {
            error_log("CRASH DI API REGISTER: " . $e->getMessage() . " di baris " . $e->getLine());

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan internal server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['status' => 'success', 'message' => 'Logout berhasil'], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal logout: ' . $e->getMessage()], 500);
        }
    }
}