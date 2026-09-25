<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidDaftarInformasiPublik extends Model
{
    protected $table = 'ppid_daftar_informasi_publiks';
    protected $fillable = ['nama_dokumen', 'tahun', 'file'];

    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }
}