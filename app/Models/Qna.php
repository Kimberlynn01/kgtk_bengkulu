<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Qna extends Model
{
    use HasFactory;
    protected $table;
    protected $fillable = [
        'name',
        'email',
        'instansi',
        'phone',
        'category_id',
        'question',
        'answer',
        'user_id',
        'answered_at',
    ];

    protected $casts = [
        'answered_at' => 'datetime',
    ];


    public function admin() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(QnaCategory::class, 'category_id');
    }
}
