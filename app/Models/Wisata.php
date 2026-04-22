<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'data_wisata';
    protected $primaryKey = 'id_wisata';
    public $timestamps = false;

    protected $fillable = [
        'nama_wisata',
        'lokasi',
        'tiket_dewasa',
        'tiket_anak',
        'biaya_asuransi',
        'fasilitas',
        'deskripsi',
        'gambar',
        'nama_admin',
    ];

    // Relasi ke transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_wisata', 'id_wisata');
    }

    // Helper: URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/destinasi/' . $this->gambar);
        }
        return asset('images/placeholder.jpg');
    }
}