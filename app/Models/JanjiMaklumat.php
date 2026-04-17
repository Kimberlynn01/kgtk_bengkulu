<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JanjiMaklumat extends Model
{
    protected $table = 'janji_maklumats';
    protected $fillable = ['title'];

    public function images(): HasMany
    {
        return $this->hasMany(JanjiMaklumatImage::class);
    }
}
