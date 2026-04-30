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
        // 'event' <--- SUDAH DIHAPUS KARENA KOLOMNYA UDAH ALMARHUM
    ];

    // Relasi ke transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_wisata', 'id_wisata');
    }

    // TAMBAHAN BARU: Relasi ke tabel galeri_event
    // (Biar enak kalau besok-besok lu mau manggil via Eloquent ORM)
    public function galeri()
    {
        // Pastikan Model GaleriEvent sudah ada, kalau belum biarkan ini jadi investasi masa depan
        return $this->hasMany(GaleriEvent::class, 'id_wisata', 'id_wisata');
    }

    // Helper: URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->gambar) {
            // REVISI: Disesuaikan dengan path di WisataController lu (images/destinasi)
            return asset('images/destinasi/' . $this->gambar);
        }
        return asset('images/placeholder.jpg');
    }
}