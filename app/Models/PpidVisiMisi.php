<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PpidVisiMisi extends Model
{
    protected $table = 'ppid_visi_misis';
    protected $fillable = ['title', 'description'];

    public function images(): HasMany
    {
        return $this->hasMany(PpidVisiMisiImage::class, 'ppid_visi_misi_id');
    }
}