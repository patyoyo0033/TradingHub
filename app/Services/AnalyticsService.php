<?php

namespace App\Services;

use App\Models\Trade;
use Illuminate\Support\Collection;

class AnalyticsService
{
    /**
     * Get summary metrics for a user's trades
     */
    public function getMetrics(int $userId): array
    {
        $trades = Trade::where('user_id', $userId)->get();
        
        $totalTrades = $trades->count();
        $winningTrades = $trades->where('pnl_amount', '>', 0);
        $losingTrades = $trades->where('pnl_amount', '<', 0);
        
        $winCount = $winningTrades->count();
        $lossCount = $losingTrades->count();
        
        $winRate = $totalTrades > 0 ? ($winCount / $totalTrades) * 100 : 0;
        
        $totalPnL = $trades->sum('pnl_amount');
        
        $grossProfit = $winningTrades->sum('pnl_amount');
        $grossLoss = abs($losingTrades->sum('pnl_amount'));
        
        $profitFactor = $grossLoss > 0 ? $grossProfit / $grossLoss : ($grossProfit > 0 ? $grossProfit : 0);

        return [
            'total_trades' => $totalTrades,
            'win_rate' => round($winRate, 2),
            'total_pnl' => round($totalPnL, 2),
            'profit_factor' => round($profitFactor, 2),
            'wins' => $winCount,
            'losses' => $lossCount,
            'breakevens' => $totalTrades - $winCount - $lossCount,
        ];
    }

    /**
     * Get cumulative equity curve data grouped by date
     */
    public function getEquityCurve(int $userId): array
    {
        $trades = Trade::where('user_id', $userId)
            ->orderBy('trade_date', 'asc')
            ->get();

        $dailyPnL = $trades->groupBy(function($trade) {
            return $trade->trade_date->format('Y-m-d');
        })->map(function ($dayTrades) {
            return $dayTrades->sum('pnl_amount');
        });

        $labels = [];
        $data = [];
        $cumulative = 0;

        foreach ($dailyPnL as $date => $pnl) {
            $cumulative += $pnl;
            $labels[] = $date;
            $data[] = round($cumulative, 2);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
