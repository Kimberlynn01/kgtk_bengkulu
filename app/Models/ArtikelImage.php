<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtikelImage extends Model
{
    protected $fillable = ['artikel_id', 'image'];

    public function artikel(): BelongsTo
    {
        return $this->belongsTo(Artikel::class);
    }
}
