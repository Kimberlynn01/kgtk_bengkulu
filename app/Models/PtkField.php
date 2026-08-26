<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PtkField extends Model
{
    protected $fillable = ['label', 'key', 'type', 'options', 'is_required', 'is_filterable', 'sort_order'];

    protected $casts = [
        'options'       => 'array',
        'is_required'   => 'boolean',
        'is_filterable' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($field) {
            if (empty($field->key)) {
                $field->key = Str::slug($field->label, '_');
            }
        });
    }
}