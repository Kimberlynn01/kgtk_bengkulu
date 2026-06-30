<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSasaran extends Model
{
    protected $table = 'data_sasarans';
    protected $fillable = ['title', 'description', 'file'];
}
