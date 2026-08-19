<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    protected $appends = ['image_url'];

    protected $table = 'sejarahs';

    protected $fillable = ['title', 'description', 'image'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
