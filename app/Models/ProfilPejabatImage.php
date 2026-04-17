<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfilPejabatImage extends Model
{
    protected $fillable = ['profil_pejabat_id', 'image'];

    public function profilPejabat(): BelongsTo
    {
        return $this->belongsTo(ProfilPejabat::class);
    }
}
