<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_pemesanan';
    public $timestamps = false;

    protected $fillable = [
        'nama_customer',
        'tlp_costumer',    // sengaja typo sesuai nama kolom di DB
        'tanggal_pesan',
        'jml_tiket',
        'harga_total',
        'id_wisata',
        'id_customer',
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'id_wisata', 'id_wisata');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function riwayat()
    {
        return $this->hasOne(RiwayatTransaksi::class, 'id_pemesanan', 'id_pemesanan');
    }
}