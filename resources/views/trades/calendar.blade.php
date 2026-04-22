<x-app-layout>
    @section('page_title', 'Trade Calendar')
    @section('page_description', 'Visualize your daily performance and consistency.')

    @php
        $currentDate = \Carbon\Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $currentDate->daysInMonth;
        $firstDayOfWeek = $currentDate->copy()->firstOfMonth()->dayOfWeek; // 0 (Sun) to 6 (Sat)
        // Adjust so Monday is 0, Sunday is 6
        $firstDayOfWeek = $firstDayOfWeek === 0 ? 6 : $firstDayOfWeek - 1;
        
        $prevMonth = $currentDate->copy()->subMonth();
        $nextMonth = $currentDate->copy()->addMonth();
    @endphp

    <div class="flex justify-between items-center mb-8">
        <div class="flex gap-2">
            <a href="{{ route('trades.index') }}" class="bg-surface-container-high text-on-surface-variant px-5 py-2.5 rounded-lg font-medium text-sm hover:bg-surface-container-highest transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">list</span>
                List View
            </a>
            <a href="{{ route('trades.calendar') }}" class="bg-primary/20 text-primary border border-primary/30 px-5 py-2.5 rounded-lg font-bold text-sm flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                Calendar View
            </a>
        </div>
        <a href="{{ route('trades.create') }}" class="bg-gradient-to-br from-primary to-primary-container text-white px-5 py-2.5 rounded-lg font-medium text-sm hover:shadow-[0_4px_12px_rgba(79,70,229,0.3)] transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            New Trade
        </a>
    </div>

    <div class="bg-surface-container-low rounded-xl border border-white/5 shadow-[0_12px_40px_rgba(11,19,38,0.3)] overflow-hidden relative max-w-6xl mx-auto">
        <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
        
        <!-- Calendar Header -->
        <div class="p-6 border-b border-outline-variant/15 flex justify-between items-center bg-surface-container-lowest/30">
            <a href="{{ route('trades.calendar', ['month' => $prevMonth->format('m'), 'year' => $prevMonth->format('Y')]) }}" class="p-2 rounded-full hover:bg-surface-container text-on-surface-variant hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined">chevron_left</span>
            </a>
            <h3 class="text-xl font-bold text-white font-headline">{{ $currentDate->format('F Y') }}</h3>
            <a href="{{ route('trades.calendar', ['month' => $nextMonth->format('m'), 'year' => $nextMonth->format('Y')]) }}" class="p-2 rounded-full hover:bg-surface-container text-on-surface-variant hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
        </div>
        
        <!-- Calendar Grid -->
        <div class="p-6">
            <div class="grid grid-cols-7 gap-2 md:gap-4 mb-4">
                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $dayName)
                    <div class="text-center text-xs font-bold text-on-surface-variant uppercase tracking-wider">{{ $dayName }}</div>
                @endforeach
            </div>

            <div class="grid grid-cols-7 gap-2 md:gap-4">
                <!-- Empty slots for days before 1st of month -->
                @for($i = 0; $i < $firstDayOfWeek; $i++)
                    <div class="h-24 md:h-32 rounded-xl bg-surface-container-lowest/30 border border-outline-variant/5"></div>
                @endfor

                <!-- Days of the month -->
                @for($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $dateStr = $currentDate->copy()->day($day)->format('Y-m-d');
                        $dayData = $dailyPnL->get($dateStr);
                        $isToday = $dateStr === now()->format('Y-m-d');
                        
                        $bgColor = 'bg-surface-container';
                        $borderColor = 'border-outline-variant/10';
                        $pnlColor = 'text-on-surface-variant';
                        
                        if ($dayData) {
                            if ($dayData['pnl'] > 0) {
                                $bgColor = 'bg-secondary/10';
                                $borderColor = 'border-secondary/30';
                                $pnlColor = 'text-secondary';
                            } elseif ($dayData['pnl'] < 0) {
                                $bgColor = 'bg-tertiary/10';
                                $borderColor = 'border-tertiary/30';
                                $pnlColor = 'text-tertiary';
                            } else {
                                $bgColor = 'bg-surface-container-high';
                                $pnlColor = 'text-on-surface';
                            }
                        }
                        
                        if ($isToday) {
                            $borderColor = 'border-primary shadow-[0_0_15px_rgba(0,212,170,0.2)]';
                        }
                    @endphp

                    <div class="h-24 md:h-32 rounded-xl {{ $bgColor }} border {{ $borderColor }} p-2 md:p-3 relative group transition-all hover:scale-[1.02] hover:shadow-lg flex flex-col">
                        <span class="text-xs md:text-sm font-bold {{ $isToday ? 'text-primary' : 'text-on-surface-variant' }}">{{ $day }}</span>
                        
                        @if($dayData)
                            <div class="mt-auto flex flex-col items-end">
                                <span class="text-[10px] text-on-surface-variant mb-1">{{ $dayData['count'] }} Trade(s)</span>
                                <span class="text-xs md:text-sm font-bold font-mono {{ $pnlColor }}">
                                    {{ $dayData['pnl'] > 0 ? '+' : '' }}${{ number_format($dayData['pnl'], 2) }}
                                </span>
                            </div>
                            
                            <!-- Hover Details (Desktop) -->
                            <div class="absolute inset-0 bg-surface-container-highest/95 backdrop-blur-sm rounded-xl p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200 hidden md:flex flex-col z-10 overflow-hidden border border-outline-variant/30">
                                <span class="text-xs font-bold text-white border-b border-outline-variant/20 pb-1 mb-2">Trades</span>
                                <div class="overflow-y-auto flex-1 space-y-1 pr-1 custom-scrollbar">
                                    @foreach($dayData['trades'] as $trade)
                                        <div class="text-[10px] flex justify-between items-center">
                                            <span class="font-bold text-white">{{ substr($trade->pair, 0, 6) }}</span>
                                            <span class="font-mono {{ $trade->pnl_amount > 0 ? 'text-secondary' : 'text-tertiary' }}">
                                                ${{ number_format($trade->pnl_amount, 2) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    </div>
</x-app-layout>
