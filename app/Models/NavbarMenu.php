<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavbarMenu extends Model
{
    protected $fillable = ['parent_id', 'name', 'slug', 'path', 'icon', 'sort_order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavbarMenu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavbarMenu::class, 'parent_id')
            ->orderBy('sort_order')
            ->with('children');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id')->orderBy('sort_order');
    }
}