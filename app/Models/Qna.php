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
        'category',
        'question',
        'answer',
        'user_id',
    ];


    public function admin() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
