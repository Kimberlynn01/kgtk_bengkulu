<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeningkatanGuru extends Model
{
    protected $table = 'peningkatan_gurus';

    protected $fillable = ['image', 'deskripsi'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
