<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeritaImage extends Model
{
    protected $fillable = ['berita_id', 'image'];

    public function berita(): BelongsTo
    {
        return $this->belongsTo(Berita::class);
    }
}
