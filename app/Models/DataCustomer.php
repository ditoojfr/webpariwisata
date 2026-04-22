<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataCustomer extends Model
{
    protected $table = 'data_customer';
    protected $primaryKey = 'id_customer';
    public $timestamps = false; // sesuaikan jika tabel tidak ada created_at/updated_at

    protected $fillable = [
        'id_customer',
        'nama_customer',
        'email_customer',
        'no_tlp',
        'password_customer',
        'foto',
    ];

    public function akun()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }
}