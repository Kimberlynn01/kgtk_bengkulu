<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KemitraanFile extends Model
{
    protected $fillable = ['kemitraan_id', 'file'];

    public function kemitraan(): BelongsTo
    {
        return $this->belongsTo(Kemitraan::class);
    }
}
