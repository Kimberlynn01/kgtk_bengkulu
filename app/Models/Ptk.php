<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ptk extends Model
{
    protected $fillable = ['data', 'jumlah'];

    protected $casts = [
        'data'   => 'array',
        'jumlah' => 'integer',
    ];

    public function value(string $key)
    {
        return $this->data[$key] ?? null;
    }
}