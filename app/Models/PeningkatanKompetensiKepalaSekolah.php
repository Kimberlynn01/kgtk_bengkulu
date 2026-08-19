<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeningkatanKompetensiKepalaSekolah extends Model
{
    protected $table = 'peningkatan_kompetensi_kepala_sekolahs';

    protected $fillable = ['image', 'deskripsi'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
