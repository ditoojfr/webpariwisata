<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    // Login mobile (menggantikan nganjukabirupa/apimobile/login.php)
    public function login(Request $request)
    {
        $data = $request->json()->all();
        $nama = $data['nama_customer'] ?? '';
        $password = $data['password_customer'] ?? '';

        if (empty($nama) || empty($password)) {
            return response()->json(['success' => false, 'message' => 'Nama dan password wajib diisi']);
        }

        $customer = Customer::where('nama_customer', $nama)->first();

        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Nama tidak ditemukan']);
        }

        // Support plain text lama DAN bcrypt baru
        $valid = Hash::check($password, $customer->password_customer)
            || $password === $customer->password_customer;

        if (!$valid) {
            return response()->json(['success' => false, 'message' => 'Password salah']);
        }

        $token = $customer->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success'        => true,
            'message'        => 'Login berhasil',
            'id_customer'    => $customer->id_customer,
            'nama_customer'  => $customer->nama_customer,
            'email_customer' => $customer->email_customer,
            'token'          => $token,
        ]);
    }

    // Register mobile (menggantikan apimobile/register.php)
    public function register(Request $request)
    {
        $data = $request->json()->all();

        $nama     = trim($data['nama_customer'] ?? '');
        $email    = trim($data['email_customer'] ?? '');
        $no_tlp   = trim($data['no_tlp'] ?? '');
        $password = trim($data['password_customer'] ?? '');

        if (empty($nama) || empty($email) || empty($password)) {
            return response()->json(['success' => false, 'message' => 'Nama, email, dan password wajib diisi']);
        }

        // Cek duplikat
        $exist = Customer::where('nama_customer', $nama)
            ->orWhere('email_customer', $email)
            ->first();

        if ($exist) {
            $id_customer = $exist->id_customer;
        } else {
            $customer = Customer::create([
                'nama_customer'     => $nama,
                'email_customer'    => $email,
                'password_customer' => Hash::make($password),
            ]);
            $id_customer = $customer->id_customer;
        }

        // Insert/update data_customer
        DataCustomer::updateOrCreate(
            ['id_customer' => $id_customer],
            [
                'nama_customer'     => $nama,
                'email_customer'    => $email,
                'no_tlp'            => $no_tlp,
                'password_customer' => Hash::make($password),
            ]
        );

        return response()->json([
            'success'     => true,
            'message'     => 'Registrasi berhasil',
            'id_customer' => $id_customer,
            'no_tlp'      => $no_tlp,
        ]);
    }

    // Logout API
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logout berhasil']);
    }
}