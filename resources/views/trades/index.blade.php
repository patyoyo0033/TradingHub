<x-app-layout>
    @section('page_title', 'Execution History')
    @section('page_description', 'Your complete trading log and past executions.')

    <div class="bg-surface-container-low rounded-xl border border-white/5 shadow-[0_12px_40px_rgba(11,19,38,0.3)] overflow-hidden relative max-w-6xl mx-auto">
        <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
        <div class="p-6 border-b border-outline-variant/15 flex flex-col md:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-white">All Trades</h3>
            
            <div class="flex gap-2">
                <a href="{{ route('trades.index') }}" class="bg-primary/20 text-primary border border-primary/30 px-4 py-2 rounded-lg font-bold text-sm flex items-center justify-center gap-2 transition-all">
                    <span class="material-symbols-outlined text-[18px]">list</span>
                    List
                </a>
                <a href="{{ route('trades.calendar') }}" class="bg-surface-container-high text-on-surface-variant hover:bg-surface-container-highest px-4 py-2 rounded-lg font-medium text-sm flex items-center justify-center gap-2 transition-all">
                    <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                    Calendar
                </a>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-wider font-body bg-surface-container-lowest/50">Pair</th>
                        <th class="px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-wider font-body bg-surface-container-lowest/50">Date &amp; Time</th>
                        <th class="px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-wider font-body bg-surface-container-lowest/50">Session</th>
                        <th class="px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-wider font-body bg-surface-container-lowest/50">Strategy</th>
                        <th class="px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-wider font-body bg-surface-container-lowest/50 text-right">Net PNL</th>
                        <th class="px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-wider font-body bg-surface-container-lowest/50 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y-0 text-sm font-medium">
                    @forelse($trades as $trade)
                    <tr class="group hover:bg-surface-container/80 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center border border-outline-variant/20 shadow-sm">
                                    <span class="text-white font-bold text-xs tracking-tighter">{{ substr($trade->pair, 0, 3) }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-white font-semibold flex items-center gap-2">
                                        {{ $trade->pair }}
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded {{ $trade->direction === 'BUY' ? 'bg-primary-container/20 text-primary' : 'bg-tertiary/20 text-tertiary' }}">{{ $trade->direction }}</span>
                                    </span>
                                    @if($trade->lot_size)
                                        <span class="text-on-surface-variant text-xs font-mono">{{ $trade->lot_size }} Lots</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="text-on-surface">{{ $trade->trade_date->format('M d, Y') }}</span>
                                <span class="text-on-surface-variant text-xs">{{ $trade->trade_date->format('H:i:s') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-on-surface-variant bg-surface-container-highest px-2 py-1 rounded text-xs font-bold uppercase">{{ $trade->session }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1 max-w-[150px]">
                                @if(is_array($trade->strategy_tags))
                                    @foreach(array_slice($trade->strategy_tags, 0, 2) as $tag)
                                        <span class="inline-flex items-center bg-primary-container text-on-primary-container rounded-full px-2 py-0.5 text-[10px] font-medium shadow-sm whitespace-nowrap">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                    @if(count($trade->strategy_tags) > 2)
                                        <span class="inline-flex items-center bg-surface-container-highest text-on-surface-variant rounded-full px-2 py-0.5 text-[10px] font-medium whitespace-nowrap">
                                            +{{ count($trade->strategy_tags) - 2 }}
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right font-headline font-bold {{ $trade->pnl_amount >= 0 ? 'text-secondary' : 'text-tertiary' }}">
                            {{ $trade->pnl_amount >= 0 ? '+' : '' }}${{ number_format($trade->pnl_amount, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <a href="{{ route('trades.edit', $trade) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-surface-container hover:bg-primary/20 text-on-surface-variant hover:text-primary transition-colors mr-2" title="Edit">
                                <span class="material-symbols-outlined text-[16px]">edit</span>
                            </a>
                            <form action="{{ route('trades.destroy', $trade) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this trade?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-surface-container hover:bg-tertiary/20 text-on-surface-variant hover:text-tertiary transition-colors" title="Delete">
                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                            No trades recorded yet. <a href="{{ route('trades.create') }}" class="text-primary hover:underline">Log a trade now</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
