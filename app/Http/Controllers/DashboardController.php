<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(private \App\Services\AnalyticsService $analyticsService) {}

    public function index()
    {
        $user = Auth::user();
        
        $metrics = $this->analyticsService->getMetrics($user->id);
        $equityCurve = $this->analyticsService->getEquityCurve($user->id);
        
        $recentTrades = $user->trades()->latest('trade_date')->take(5)->get();
        
        $bestPair = $user->trades()->get()->groupBy('pair')->map(function ($pairTrades) {
            return $pairTrades->sum('pnl_amount');
        })->sortDesc()->keys()->first() ?? 'N/A';

        return view('dashboard', compact('metrics', 'equityCurve', 'bestPair', 'recentTrades'));
    }
}
