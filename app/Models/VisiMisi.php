<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisiMisi extends Model
{
    protected $table = 'visi_misis';
    protected $fillable = ['title', 'description'];

    public function images(): HasMany
    {
        return $this->hasMany(VisiMisiImage::class);
    }
}
