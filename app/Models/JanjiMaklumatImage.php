<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JanjiMaklumatImage extends Model
{
    protected $fillable = ['janji_maklumat_id', 'image'];

    public function janjiMaklumat(): BelongsTo
    {
        return $this->belongsTo(JanjiMaklumat::class);
    }
}
