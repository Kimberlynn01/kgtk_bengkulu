<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerjanjianKerja extends Model
{
    protected $appends = ['pdf_url'];

    protected $table = 'perjanjian_kerjas';

    protected $fillable = ['title', 'description', 'pdf'];

    public function getPdfUrlAttribute()
    {
        return $this->pdf ? asset('storage/' . $this->pdf) : null;
    }
}
