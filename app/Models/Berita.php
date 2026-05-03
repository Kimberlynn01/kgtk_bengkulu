<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $fillable = ['date', 'title', 'content', 'slug'];

    protected static function booted()
    {
        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->title);
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('title')) {
                $berita->slug = Str::slug($berita->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images(): HasMany
    {
        return $this->hasMany(BeritaImage::class);
    }
}
