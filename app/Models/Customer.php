<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'akun_customer'; //
    protected $primaryKey = 'id_customer'; //
    public $timestamps = false; //

    protected $fillable = [
        'nama_customer',
        'email_customer',
        'no_tlp',
        'password_customer',
        'tanggal_daftar',
    ]; //[cite: 6]

    protected $hidden = [
        'password_customer',
    ]; //[cite: 6]

    // Beritahu Laravel kalau kolom password-nya bernama 'password_customer'[cite: 6]
    public function getAuthPassword()
    {
        return $this->password_customer;
    }

    /**
     * RELASI TABEL - JANGAN DIHAPUS LAGI BRE!
     */

    // 1. Relasi ke data profil tambahan (Penting buat Registrasi)[cite: 6]
    public function dataCustomer()
    {
        return $this->hasOne(DataCustomer::class, 'id_customer', 'id_customer');
    }

    // 2. Relasi ke Ulasan[cite: 6]
    public function ulasan()
    {
        return $this->hasMany(UlasanWisata::class, 'id_customer', 'id_customer');
    }

    // 3. Relasi ke Transaksi[cite: 6]
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_customer', 'id_customer');
    }

    // 4. Relasi ke Riwayat[cite: 6]
    public function riwayat()
    {
        return $this->hasMany(RiwayatTransaksi::class, 'id_customer', 'id_customer');
    }
}