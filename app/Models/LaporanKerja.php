<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKerja extends Model
{
    protected $appends = ['pdf_url'];

    protected $table = 'laporan_kerjas';

    protected $fillable = ['title', 'description', 'pdf'];

    public function getPdfUrlAttribute()
    {
        return $this->pdf ? asset('storage/' . $this->pdf) : null;
    }
}
