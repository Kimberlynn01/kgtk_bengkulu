<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidLayananInformasi extends Model
{
    protected $table = 'ppid_layanan_informasis';
    protected $fillable = ['nama_dokumen', 'tahun', 'file'];

    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }
}