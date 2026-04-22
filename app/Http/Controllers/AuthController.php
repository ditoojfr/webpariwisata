<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // ─── Tampilkan halaman login ─────────────────────────────────────────────
    public function showLogin()
    {
        // Kalau sudah login, langsung redirect sesuai role
        if (session('role') === 'admin') {
            return redirect('/admin/beranda');
        }
        if (session('id_customer')) {
            return redirect('/beranda');
        }
        return view('auth.login');
    }

    // ─── Proses login (selalu kembalikan JSON) ────────────────────────────────
    public function login(Request $request)
    {
        // Pastikan selalu return JSON — tidak pernah redirect dari sini
        $email    = trim($request->input('email', ''));
        $password = $request->input('password', '');
        $role     = $request->input('role', 'user'); // 'user' atau 'admin'

        // Validasi input kosong
        if (empty($email) || empty($password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email dan kata sandi wajib diisi.',
            ]);
        }

        // ── LOGIN ADMIN ──────────────────────────────────────────────────────
        if ($role === 'admin') {
            $admin = DB::table('data_admin')
                ->where('email', $email)
                ->first();

            if (!$admin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email admin tidak ditemukan.',
                ]);
            }

            // Cek password — dukung plain text (lama) dan bcrypt (baru)
            $passwordMatch = Hash::check($password, $admin->password)
                || $password === $admin->password;

            if (!$passwordMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password admin salah.',
                ]);
            }

            // Set session admin
            session([
                'role'       => 'admin',
                'user_id'    => $admin->id_admin,
                'user_name'  => $admin->nama_admin,
                'user_email' => $admin->email,
            ]);

            return response()->json([
                'success'  => true,
                'redirect' => '/admin/beranda',
            ]);
        }

        // ── LOGIN USER ───────────────────────────────────────────────────────
        $customer = Customer::where('email_customer', $email)->first();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan.',
            ]);
        }

        // Dukung plain text lama DAN bcrypt baru
        $passwordMatch = Hash::check($password, $customer->password_customer)
            || $password === $customer->password_customer;

        if (!$passwordMatch) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah.',
            ]);
        }

        // Set session user
        session([
            'id_customer' => $customer->id_customer,
            'user_id'     => $customer->id_customer,
            'user_name'   => $customer->nama_customer,
            'user_email'  => $customer->email_customer,
            'role'        => 'user',
        ]);

        return response()->json([
            'success'  => true,
            'redirect' => '/beranda',
        ]);
    }

    // ─── Tampilkan halaman register ──────────────────────────────────────────
    public function showRegister()
    {
        return view('auth.register');
    }

    // ─── Proses register ─────────────────────────────────────────────────────
    public function register(Request $request)
    {
        $fullname = trim($request->input('fullname', ''));
        $email    = trim($request->input('email', ''));
        $phone    = trim($request->input('phone', ''));
        $password = $request->input('password', '');

        if (empty($fullname) || empty($email) || empty($phone) || empty($password)) {
            return response()->json([
                'success' => false,
                'message' => 'Semua field wajib diisi.',
            ]);
        }

        if (strlen($password) < 6) {
            return response()->json([
                'success' => false,
                'message' => 'Password minimal 6 karakter.',
            ]);
        }

        // Cek duplikat email
        if (Customer::where('email_customer', $email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah terdaftar.',
            ]);
        }

        // Simpan ke akun_customer dengan password di-hash
        $customer = Customer::create([
            'nama_customer'     => $fullname,
            'email_customer'    => $email,
            'password_customer' => Hash::make($password),
        ]);

        // Simpan juga ke data_customer (untuk profil)
        DataCustomer::firstOrCreate(
            ['id_customer' => $customer->id_customer],
            [
                'nama_customer'     => $fullname,
                'email_customer'    => $email,
                'no_tlp'            => $phone,
                'password_customer' => Hash::make($password),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil! Silakan login.',
        ]);
    }

    // ─── Logout ──────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }

    // ─── Google OAuth: redirect ke Google ────────────────────────────────────
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // ─── Google OAuth: callback dari Google ──────────────────────────────────
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login via Google.');
        }

        $customer = Customer::where('email_customer', $googleUser->email)->first();

        if (!$customer) {
            $customer = Customer::create([
                'nama_customer'     => $googleUser->name,
                'email_customer'    => $googleUser->email,
                'password_customer' => Hash::make('google_' . time()),
            ]);

            DataCustomer::firstOrCreate(
                ['id_customer' => $customer->id_customer],
                [
                    'nama_customer'  => $googleUser->name,
                    'email_customer' => $googleUser->email,
                ]
            );
        }

        session([
            'id_customer' => $customer->id_customer,
            'user_id'     => $customer->id_customer,
            'user_name'   => $customer->nama_customer,
            'user_email'  => $customer->email_customer,
            'role'        => 'user',
        ]);

        return redirect('/beranda');
    }

    // ─── Google Login via token (dari blade/JS) ───────────────────────────────
    public function handleGoogleToken(Request $request)
    {
        $token = $request->input('google_token', '');

        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Token Google tidak valid.']);
        }

        // Verifikasi token ke Google
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return response()->json(['success' => false, 'message' => 'Gagal memverifikasi token Google.']);
        }

        $googleUser = json_decode($response, true);
        if (!isset($googleUser['email'])) {
            return response()->json(['success' => false, 'message' => 'Data Google tidak lengkap.']);
        }

        $customer = Customer::where('email_customer', $googleUser['email'])->first();

        if (!$customer) {
            $customer = Customer::create([
                'nama_customer'     => $googleUser['name'] ?? $googleUser['email'],
                'email_customer'    => $googleUser['email'],
                'password_customer' => Hash::make('google_' . time()),
            ]);
        }

        session([
            'id_customer' => $customer->id_customer,
            'user_id'     => $customer->id_customer,
            'user_name'   => $customer->nama_customer,
            'user_email'  => $customer->email_customer,
            'role'        => 'user',
        ]);

        return response()->json(['success' => true, 'redirect' => '/beranda']);
    }
}
