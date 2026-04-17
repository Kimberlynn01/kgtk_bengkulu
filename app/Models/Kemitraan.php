<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kemitraan extends Model
{
    protected $table = 'kemitraans';
    protected $fillable = ['title', 'description'];

    public function files(): HasMany
    {
        return $this->hasMany(KemitraanFile::class);
    }
}
