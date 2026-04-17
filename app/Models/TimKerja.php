<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimKerja extends Model
{
    protected $table = 'tim_kerjas';
    protected $fillable = ['title', 'description'];

    public function images(): HasMany
    {
        return $this->hasMany(TimKerjaImage::class);
    }
}
