<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpidVisiMisiImage extends Model
{
    protected $table = 'ppid_visi_misi_images';
    protected $fillable = ['ppid_visi_misi_id', 'image'];

    public function ppidVisiMisi(): BelongsTo
    {
        return $this->belongsTo(PpidVisiMisi::class, 'ppid_visi_misi_id');
    }
}