<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidInformasiDikecualikan extends Model
{
    protected $table = 'ppid_informasi_dikecualikans';
    protected $fillable = ['nama_dokumen', 'tahun', 'file'];

    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }
}