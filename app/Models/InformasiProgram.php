<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InformasiProgram extends Model
{
    protected $table = 'informasi_programs';
    protected $fillable = ['title'];

    public function files(): HasMany
    {
        return $this->hasMany(InformasiProgramFile::class);
    }
}
