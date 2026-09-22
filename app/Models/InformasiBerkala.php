<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiBerkala extends Model
{
    protected $fillable = ['nama_dokumen', 'tahun', 'file'];

    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }
}