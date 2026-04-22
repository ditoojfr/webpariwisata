<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksi extends Model
{
    protected $table = 'riwayat_transaksi';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'id_pemesanan',
        'tgl_pesanan',
        'status',
        'harga_total',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }
}