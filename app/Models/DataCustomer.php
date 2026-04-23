<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataCustomer extends Model
{
    protected $table = 'data_customer';
    protected $primaryKey = 'id_customer';
    public $timestamps = false; 

    protected $fillable = [
        'id_customer',
        'nama_customer',
        'email_customer',
        'no_tlp',
        'password_customer',
        'foto',
    ];

    // TAMBAHKAN INI: Agar Laravel tidak salah asumsi tentang format password
    protected $casts = [
        'password_customer' => 'string',
    ];

    public function akun()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }
}