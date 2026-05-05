<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'akun_customer';
    protected $primaryKey = 'id_customer';
    public $timestamps = false;

    protected $fillable = [
        'nama_customer',
        'email_customer',
        'password_customer',
        'tanggal_daftar',
    ];

    protected $hidden = ['password_customer'];

    // PENTING: Tambahkan ini agar Laravel tidak mencoba 
    // memproses password_customer sebagai objek tersembunyi/hash otomatis
    protected $casts = [
        'password_customer' => 'string', 
    ];

    // Override getAuthPassword agar Laravel tahu field password-nya
    public function getAuthPassword()
    {
        return $this->password_customer;
    }

    // Relasi lainnya...
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_customer', 'id_customer');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatTransaksi::class, 'id_customer', 'id_customer');
    }

    public function dataCustomer()
    {
        return $this->hasOne(DataCustomer::class, 'id_customer', 'id_customer');
    }

    public function ulasan()
{
    return $this->hasMany(UlasanWisata::class, 'id_customer', 'id_customer');
}
}