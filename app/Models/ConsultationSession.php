<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ConsultationSession extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'gmeet_link', 'image', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    protected static function booted()
    {
        static::creating(function ($session) {
            if (empty($session->slug)) {
                $session->slug = Str::slug($session->title);
            }
        });
    }
}