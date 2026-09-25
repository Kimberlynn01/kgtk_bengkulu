<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidTugasFungsi extends Model
{
    protected $table = 'ppid_tugas_fungsis';
    protected $fillable = ['title', 'description', 'image'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}