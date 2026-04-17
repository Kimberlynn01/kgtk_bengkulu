<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisiMisiImage extends Model
{
    protected $fillable = ['visi_misi_id', 'image'];

    public function visiMisi(): BelongsTo
    {
        return $this->belongsTo(VisiMisi::class);
    }
}
