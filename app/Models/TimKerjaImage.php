<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimKerjaImage extends Model
{
    protected $fillable = ['tim_kerja_id', 'image'];

    public function timKerja(): BelongsTo
    {
        return $this->belongsTo(TimKerja::class);
    }
}
