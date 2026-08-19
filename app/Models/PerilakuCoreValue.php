<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerilakuCoreValue extends Model
{
    protected $appends = ['pdf_url'];

    protected $table = 'perilaku_core_values';

    protected $fillable = ['title', 'description', 'pdf'];

    public function getPdfUrlAttribute()
    {
        return $this->pdf ? asset('storage/' . $this->pdf) : null;
    }
}
