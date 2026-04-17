<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfilPejabat extends Model
{
    protected $table = 'profil_pejabats';
    protected $fillable = ['title'];

    public function images(): HasMany
    {
        return $this->hasMany(ProfilPejabatImage::class);
    }
}
