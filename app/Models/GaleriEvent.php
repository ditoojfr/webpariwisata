<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriEvent extends Model
{
    protected $table = 'galeri_event';
    protected $primaryKey = 'id_galeri';
    // public $timestamps = true; // Biarin nyala karena di controller tadi lu pake timestamps

    protected $fillable = [
        'id_wisata',
        'gambar_poster'
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'id_wisata', 'id_wisata');
    }
}
