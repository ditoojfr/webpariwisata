<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanWisata extends Model
{
    protected $table = 'ulasan_wisata'; 
    protected $primaryKey = 'id_ulasan';
    public $timestamps = false; 

    // WAJIB TAMBAHIN INI BIAR BISA SIMPAN DATA DARI FLUTTER
    protected $fillable = [
        'id_wisata',
        'id_customer',
        'ulasan',
        'tanggal'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }
}