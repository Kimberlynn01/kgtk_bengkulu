<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Skm extends Model
{
    protected $fillable = ['title', 'description', 'link'];
}
