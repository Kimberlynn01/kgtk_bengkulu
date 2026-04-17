<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InformasiProgramFile extends Model
{
    protected $fillable = ['informasi_program_id', 'file'];

    public function informasiProgram(): BelongsTo
    {
        return $this->belongsTo(InformasiProgram::class);
    }
}
