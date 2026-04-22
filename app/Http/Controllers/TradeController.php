<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTradeRequest;
use App\Http\Requests\UpdateTradeRequest;
use App\Models\Trade;
use App\Services\TradeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    use AuthorizesRequests;

    public function __construct(private TradeService $tradeService) {}

    public function index()
    {
        $trades = Auth::user()->trades()->latest('trade_date')->get();
        return view('trades.index', compact('trades'));
    }

    public function calendar(\Illuminate\Http\Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $trades = Auth::user()->trades()
            ->whereMonth('trade_date', $month)
            ->whereYear('trade_date', $year)
            ->get();

        $dailyPnL = $trades->groupBy(function($trade) {
            return $trade->trade_date->format('Y-m-d');
        })->map(function ($dayTrades) {
            return [
                'pnl' => $dayTrades->sum('pnl_amount'),
                'count' => $dayTrades->count(),
                'trades' => $dayTrades
            ];
        });

        return view('trades.calendar', compact('dailyPnL', 'month', 'year'));
    }

    public function create()
    {
        return view('trades.create');
    }

    public function store(StoreTradeRequest $request)
    {
        $this->tradeService->storeTrade(
            $request->validated(),
            Auth::id(),
            $request->file('image_path')
        );

        return redirect()->route('trades.index')->with('success', 'Trade recorded successfully.');
    }

    public function show(Trade $trade)
    {
        $this->authorize('view', $trade);
        return view('trades.show', compact('trade'));
    }

    public function edit(Trade $trade)
    {
        $this->authorize('update', $trade);
        return view('trades.edit', compact('trade'));
    }

    public function update(UpdateTradeRequest $request, Trade $trade)
    {
        $this->authorize('update', $trade);

        $this->tradeService->updateTrade(
            $trade,
            $request->validated(),
            $request->file('image_path')
        );

        return redirect()->route('trades.index')->with('success', 'Trade updated successfully.');
    }

    public function destroy(Trade $trade)
    {
        $this->authorize('delete', $trade);
        
        $this->tradeService->deleteTrade($trade);
        
        return redirect()->route('trades.index')->with('success', 'Trade deleted successfully.');
    }
}
