<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pair' => 'required|string|max:255',
            'direction' => 'required|in:BUY,SELL',
            'trade_date' => 'required|date',
            'session' => 'required|in:Asian,London,New York,Overlap',
            'duration_minutes' => 'nullable|integer',
            'entry_price' => 'required|numeric',
            'tp_price' => 'nullable|numeric',
            'sl_price' => 'nullable|numeric',
            'lot_size' => 'nullable|numeric',
            'pnl_amount' => 'required|numeric',
            'risk_reward' => 'nullable|numeric',
            'setup_quality' => 'nullable|integer|min:1|max:5',
            'emotion' => 'nullable|in:Neutral,Confident,FOMO,Revenge,Anxious',
            'strategy_tags' => 'nullable|array',
            'mistake_flag' => 'boolean',
            'emotion_notes' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
        ];
    }
}
