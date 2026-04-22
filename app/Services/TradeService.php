<?php

namespace App\Services;

use App\Models\Trade;
use Illuminate\Support\Facades\Storage;

class TradeService
{
    /**
     * Calculate Risk Reward Ratio if entry, tp, and sl are provided.
     */
    public function calculateRiskReward(float $entry, ?float $tp, ?float $sl, string $direction): ?float
    {
        if ($tp === null || $sl === null) {
            return null;
        }

        $risk = abs($entry - $sl);
        $reward = abs($tp - $entry);

        if ($risk == 0) {
            return null;
        }

        return round($reward / $risk, 2);
    }

    /**
     * Store a new trade and handle optional image upload.
     */
    public function storeTrade(array $data, int $userId, $imageFile = null): Trade
    {
        $data['user_id'] = $userId;

        // Auto-calculate RR if not provided
        if (!isset($data['risk_reward']) || $data['risk_reward'] === null) {
            $data['risk_reward'] = $this->calculateRiskReward(
                (float) $data['entry_price'],
                isset($data['tp_price']) ? (float) $data['tp_price'] : null,
                isset($data['sl_price']) ? (float) $data['sl_price'] : null,
                $data['direction']
            );
        }

        if ($imageFile) {
            $data['image_path'] = $imageFile->store('trades', 'public');
        }

        return Trade::create($data);
    }

    /**
     * Update an existing trade and handle image replacement.
     */
    public function updateTrade(Trade $trade, array $data, $imageFile = null): Trade
    {
        // Auto-calculate RR if not provided
        if (!isset($data['risk_reward']) || $data['risk_reward'] === null) {
            $data['risk_reward'] = $this->calculateRiskReward(
                (float) $data['entry_price'],
                isset($data['tp_price']) ? (float) $data['tp_price'] : null,
                isset($data['sl_price']) ? (float) $data['sl_price'] : null,
                $data['direction']
            );
        }

        if ($imageFile) {
            if ($trade->image_path) {
                Storage::disk('public')->delete($trade->image_path);
            }
            $data['image_path'] = $imageFile->store('trades', 'public');
        }

        // Handle mistake_flag checkbox (if unchecked, it won't be in the request data)
        $data['mistake_flag'] = $data['mistake_flag'] ?? false;

        $trade->update($data);

        return $trade;
    }

    /**
     * Delete a trade and its associated image.
     */
    public function deleteTrade(Trade $trade): void
    {
        if ($trade->image_path) {
            Storage::disk('public')->delete($trade->image_path);
        }

        $trade->delete();
    }
}
