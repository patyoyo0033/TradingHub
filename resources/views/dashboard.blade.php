<x-app-layout>
    @section('page_title', 'Market Overview')
    @section('page_description', 'Welcome back. Market volatility is currently <span class="text-secondary font-semibold">Moderate</span>.')

    <!-- Quick Stat Cards (Bento Grid) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
        <!-- Total PNL -->
        <div class="bg-surface-container-low rounded-xl p-5 relative overflow-hidden border border-white/5 group hover:bg-surface-container transition-colors duration-300 shadow-[0_8px_24px_rgba(11,19,38,0.2)]">
            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
            <!-- Glass/Glow Effect -->
            <div class="absolute -top-10 -right-10 w-32 h-32 {{ $metrics['total_pnl'] >= 0 ? 'bg-secondary/10 group-hover:bg-secondary/20' : 'bg-tertiary/10 group-hover:bg-tertiary/20' }} rounded-full blur-3xl transition-all duration-500"></div>
            
            <div class="flex justify-between items-start mb-4 relative z-10">
                <span class="text-on-surface-variant text-xs uppercase tracking-wider font-semibold">Total PNL</span>
                <div class="w-8 h-8 rounded-full {{ $metrics['total_pnl'] >= 0 ? 'bg-secondary/10' : 'bg-tertiary/10' }} flex items-center justify-center">
                    <span class="material-symbols-outlined {{ $metrics['total_pnl'] >= 0 ? 'text-secondary' : 'text-tertiary' }} text-sm">account_balance_wallet</span>
                </div>
            </div>
            <div class="relative z-10 flex items-end justify-between">
                <h3 class="text-2xl lg:text-3xl font-headline font-bold {{ $metrics['total_pnl'] >= 0 ? 'text-secondary' : 'text-tertiary' }} mb-1">
                    {{ $metrics['total_pnl'] >= 0 ? '+' : '' }}${{ number_format($metrics['total_pnl'], 2) }}
                </h3>
            </div>
        </div>

        <!-- Win Rate -->
        <div class="bg-surface-container-low rounded-xl p-5 relative overflow-hidden border border-white/5 group hover:bg-surface-container transition-colors duration-300 shadow-[0_8px_24px_rgba(11,19,38,0.2)]">
            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/10 rounded-full blur-3xl group-hover:bg-primary/20 transition-all duration-500"></div>
            
            <div class="flex justify-between items-start mb-4 relative z-10">
                <span class="text-on-surface-variant text-xs uppercase tracking-wider font-semibold">Win Rate</span>
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-sm">pie_chart</span>
                </div>
            </div>
            <div class="relative z-10 flex items-end justify-between">
                <div>
                    <h3 class="text-2xl lg:text-3xl font-headline font-bold text-white mb-1">{{ $metrics['win_rate'] }}%</h3>
                    <span class="text-on-surface-variant text-xs font-mono">{{ $metrics['wins'] }}W / {{ $metrics['losses'] }}L</span>
                </div>
                <!-- Mini progress bar -->
                <div class="w-16 h-1.5 bg-surface-container-highest rounded-full overflow-hidden mb-2">
                    <div class="h-full bg-gradient-to-r from-primary to-primary-container rounded-full" style="width: {{ $metrics['win_rate'] }}%;"></div>
                </div>
            </div>
        </div>

        <!-- Total Trades -->
        <div class="bg-surface-container-low rounded-xl p-5 relative overflow-hidden border border-white/5 group hover:bg-surface-container transition-colors duration-300 shadow-[0_8px_24px_rgba(11,19,38,0.2)]">
            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-3xl group-hover:bg-white/10 transition-all duration-500"></div>
            
            <div class="flex justify-between items-start mb-4 relative z-10">
                <span class="text-on-surface-variant text-xs uppercase tracking-wider font-semibold">Total Trades</span>
                <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-surface text-sm">swap_vert</span>
                </div>
            </div>
            <div class="relative z-10 flex items-end justify-between">
                <div>
                    <h3 class="text-2xl lg:text-3xl font-headline font-bold text-white mb-1">{{ $metrics['total_trades'] }}</h3>
                    <span class="text-on-surface-variant text-xs">All Time</span>
                </div>
                <!-- Minimal Sparkline substitute -->
                <div class="flex items-end gap-1 h-8 opacity-60">
                    <div class="w-1.5 bg-on-surface-variant rounded-t-sm h-[40%]"></div>
                    <div class="w-1.5 bg-on-surface-variant rounded-t-sm h-[60%]"></div>
                    <div class="w-1.5 bg-on-surface-variant rounded-t-sm h-[30%]"></div>
                    <div class="w-1.5 bg-primary rounded-t-sm h-[80%]"></div>
                    <div class="w-1.5 bg-primary rounded-t-sm h-[100%]"></div>
                </div>
            </div>
        </div>

        <!-- Profit Factor -->
        <div class="bg-surface-container-low rounded-xl p-5 relative overflow-hidden border border-white/5 group hover:bg-surface-container transition-colors duration-300 shadow-[0_8px_24px_rgba(11,19,38,0.2)]">
            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-secondary/5 rounded-full blur-3xl group-hover:bg-secondary/10 transition-all duration-500"></div>
            
            <div class="flex justify-between items-start mb-4 relative z-10">
                <span class="text-on-surface-variant text-xs uppercase tracking-wider font-semibold">Profit Factor</span>
                <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-surface text-sm">monitoring</span>
                </div>
            </div>
            <div class="relative z-10">
                <h3 class="text-2xl lg:text-3xl font-headline font-bold text-white mb-1">{{ $metrics['profit_factor'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Chart & Table Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Equity Curve Chart -->
        <div class="lg:col-span-2 bg-surface-container-low rounded-xl border border-white/5 shadow-[0_12px_40px_rgba(11,19,38,0.3)] overflow-hidden relative p-6">
            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-white font-headline">Equity Curve</h3>
            </div>
            <div class="relative h-[300px] w-full">
                <canvas id="equityChart"></canvas>
            </div>
        </div>

        <!-- Recent Trades -->
        <div class="bg-surface-container-low rounded-xl border border-white/5 shadow-[0_12px_40px_rgba(11,19,38,0.3)] overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
            <div class="p-6 border-b border-outline-variant/15 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white font-headline">Recent Executions</h3>
                <a href="{{ route('trades.index') }}" class="text-sm text-primary hover:text-white transition-colors font-medium flex items-center gap-1">
                    All <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-outline-variant/10 text-sm font-medium">
                        @forelse($recentTrades as $trade)
                        <tr class="group hover:bg-surface-container/80 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="text-white font-semibold flex items-center gap-2">
                                        {{ $trade->pair }}
                                        <span class="text-[9px] font-bold px-1.5 py-0.5 rounded {{ $trade->direction === 'BUY' ? 'bg-primary-container/20 text-primary' : 'bg-tertiary/20 text-tertiary' }}">{{ $trade->direction }}</span>
                                    </span>
                                    <span class="text-on-surface-variant text-[10px]">{{ $trade->trade_date->format('M d, H:i') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right font-mono font-bold {{ $trade->pnl_amount >= 0 ? 'text-secondary' : 'text-tertiary' }}">
                                {{ $trade->pnl_amount >= 0 ? '+' : '' }}${{ number_format($trade->pnl_amount, 2) }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-on-surface-variant">
                                No recent trades.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js Setup -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('equityChart').getContext('2d');
            const equityData = @json($equityCurve['data']);
            const labels = @json($equityCurve['labels']);

            // Gradient for line fill
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(0, 212, 170, 0.2)');
            gradient.addColorStop(1, 'rgba(0, 212, 170, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cumulative PNL ($)',
                        data: equityData,
                        borderColor: '#00d4aa',
                        backgroundColor: gradient,
                        borderWidth: 2,
                        pointBackgroundColor: '#111318',
                        pointBorderColor: '#00d4aa',
                        pointBorderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1c1f26',
                            titleColor: '#8a9ab0',
                            bodyColor: '#ffffff',
                            borderColor: '#374151',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return '$' + context.parsed.y.toFixed(2);
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#8a9ab0',
                                font: {
                                    family: "'JetBrains Mono', monospace",
                                    size: 10
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(138, 154, 176, 0.1)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#8a9ab0',
                                font: {
                                    family: "'JetBrains Mono', monospace",
                                    size: 11
                                },
                                callback: function(value) {
                                    return '$' + value;
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        });
    </script>
</x-app-layout>
