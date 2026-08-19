<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class QnaCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean'];

    protected static function booted()
    {
        static::saving(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function qnas(): HasMany
    {
        return $this->hasMany(Qna::class, 'category_id');
    }
}
