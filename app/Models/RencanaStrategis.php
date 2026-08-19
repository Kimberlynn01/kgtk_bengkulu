<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaStrategis extends Model
{
    protected $appends = ['pdf_url'];

    protected $table = 'rencana_strategis';

    protected $fillable = ['title', 'description', 'pdf'];

    public function getPdfUrlAttribute()
    {
        return $this->pdf ? asset('storage/' . $this->pdf) : null;
    }
}
