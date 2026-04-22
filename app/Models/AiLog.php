<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiLog extends Model
{
    protected $fillable = [
        'user_id',
        'question',
        'answer',
        'context_used',
    ];

    protected $casts = [
        'context_used' => 'array',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
