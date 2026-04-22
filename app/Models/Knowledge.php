<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Knowledge extends Model
{
    use HasFactory;

    protected $table = 'knowledges';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'type',
        'tags',
        'example_trade_id',
        'image_path',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trade(): BelongsTo
    {
        return $this->belongsTo(Trade::class, 'example_trade_id');
    }
}
