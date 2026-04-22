<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pair',
        'direction',
        'trade_date',
        'session',
        'duration_minutes',
        'entry_price',
        'tp_price',
        'sl_price',
        'lot_size',
        'pnl_amount',
        'risk_reward',
        'setup_quality',
        'emotion',
        'strategy_tags',
        'mistake_flag',
        'emotion_notes',
        'image_path',
    ];

    protected $casts = [
        'trade_date' => 'datetime',
        'entry_price' => 'decimal:4',
        'tp_price' => 'decimal:4',
        'sl_price' => 'decimal:4',
        'lot_size' => 'decimal:2',
        'pnl_amount' => 'decimal:2',
        'risk_reward' => 'decimal:2',
        'strategy_tags' => 'array',
        'mistake_flag' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function knowledge(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Knowledge::class, 'example_trade_id');
    }
}
