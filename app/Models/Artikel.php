<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artikel extends Model
{
    protected $fillable = ['date', 'title', 'content'];

    public function images(): HasMany
    {
        return $this->hasMany(ArtikelImage::class);
    }
}
