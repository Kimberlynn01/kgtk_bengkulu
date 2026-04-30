<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Artikel extends Model
{
    protected $fillable = ['date', 'title', 'content'];

    protected static function booted()
    {
        static::creating(function ($artikel) {
            if (empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->title);
            }
        });

        static::updating(function ($artikel) {
            if ($artikel->isDirty('title')) {
                $artikel->slug = Str::slug($artikel->title);
            }
        });
    }

    public function images(): HasMany
    {
        return $this->hasMany(ArtikelImage::class);
    }
}
