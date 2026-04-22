<x-app-layout>
    @section('page_title', 'Record New Trade')
    @section('page_description', 'Log your entry, execution details, and psychology.')

    <div class="bg-surface-container-highest/60 backdrop-blur-[30px] rounded-xl p-6 md:p-8 shadow-[0_12px_32px_rgba(11,19,38,0.4)] border-t border-on-surface/10 relative overflow-hidden max-w-4xl mx-auto">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-container/20 rounded-full blur-[80px] pointer-events-none"></div>
        
        <form action="{{ route('trades.store') }}" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-8">
            @csrf
            
            <!-- Section 1: Execution Details -->
            <div>
                <h2 class="text-lg font-semibold text-primary mb-4 border-b border-surface-container-low pb-2 font-headline">Execution Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Trading Pair</label>
                        <input name="pair" value="{{ old('pair') }}" required class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm font-mono placeholder:font-sans" placeholder="e.g., XAUUSD, EURUSD" type="text"/>
                        @error('pair') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Direction</label>
                        <div class="flex gap-4 h-[46px]">
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" name="direction" value="BUY" class="peer sr-only" {{ old('direction') == 'BUY' ? 'checked' : '' }} required>
                                <div class="w-full h-full flex items-center justify-center rounded-lg border border-outline-variant/30 bg-surface-container-lowest text-black-variant peer-checked:bg-primary-container/20 peer-checked:text-primary peer-checked:border-primary transition-all">
                                    <span class="font-bold text-sm tracking-widest uppercase">Buy</span>
                                </div>
                            </label>
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" name="direction" value="SELL" class="peer sr-only" {{ old('direction') == 'SELL' ? 'checked' : '' }} required>
                                <div class="w-full h-full flex items-center justify-center rounded-lg border border-outline-variant/30 bg-surface-container-lowest text-black-variant peer-checked:bg-tertiary/20 peer-checked:text-tertiary peer-checked:border-tertiary transition-all">
                                    <span class="font-bold text-sm tracking-widest uppercase">Sell</span>
                                </div>
                            </label>
                        </div>
                        @error('direction') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Trade Date &amp; Time</label>
                        <input name="trade_date" value="{{ old('trade_date', now()->format('Y-m-d\TH:i')) }}" required class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm [color-scheme:dark]" type="datetime-local"/>
                        @error('trade_date') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Session</label>
                        <select name="session" required class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm appearance-none">
                            <option disabled selected value="">Select Session</option>
                            <option value="Asian" {{ old('session') == 'Asian' ? 'selected' : '' }}>Asian</option>
                            <option value="London" {{ old('session') == 'London' ? 'selected' : '' }}>London</option>
                            <option value="New York" {{ old('session') == 'New York' ? 'selected' : '' }}>New York</option>
                            <option value="Overlap" {{ old('session') == 'Overlap' ? 'selected' : '' }}>Overlap</option>
                        </select>
                        @error('session') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Duration (Minutes)</label>
                        <input name="duration_minutes" value="{{ old('duration_minutes') }}" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all font-mono text-sm" placeholder="e.g. 120" type="number"/>
                        @error('duration_minutes') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            
            <!-- Section 2: Pricing & Outcome -->
            <div>
                <h2 class="text-lg font-semibold text-primary mb-4 border-b border-surface-container-low pb-2 font-headline">Pricing &amp; Outcome</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Lot Size</label>
                        <input name="lot_size" value="{{ old('lot_size') }}" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all font-mono text-sm" placeholder="1.00" step="any" type="number"/>
                        @error('lot_size') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Entry Price</label>
                        <input name="entry_price" value="{{ old('entry_price') }}" required class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all font-mono text-sm" placeholder="0.0000" step="any" type="number"/>
                        @error('entry_price') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-secondary uppercase tracking-wider">Take Profit</label>
                        <input name="tp_price" value="{{ old('tp_price') }}" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary transition-all font-mono text-sm" placeholder="0.0000" step="any" type="number"/>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-tertiary uppercase tracking-wider">Stop Loss</label>
                        <input name="sl_price" value="{{ old('sl_price') }}" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tertiary transition-all font-mono text-sm" placeholder="0.0000" step="any" type="number"/>
                    </div>
                    
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Realized PNL ($)</label>
                        <input name="pnl_amount" value="{{ old('pnl_amount') }}" required class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all font-mono text-lg" placeholder="-150.00" step="any" type="number"/>
                        @error('pnl_amount') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            
            <!-- Section 3: Analysis & Psychology -->
            <div>
                <h2 class="text-lg font-semibold text-primary mb-4 border-b border-surface-container-low pb-2 font-headline">Analysis &amp; Psychology</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Strategy Tags</label>
                        <select name="strategy_tags[]" multiple class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm h-24">
                            @php $oldTags = old('strategy_tags', []); @endphp
                            <option value="SMC" {{ in_array('SMC', $oldTags) ? 'selected' : '' }}>Smart Money Concepts (SMC)</option>
                            <option value="Liquidity Sweep" {{ in_array('Liquidity Sweep', $oldTags) ? 'selected' : '' }}>Liquidity Sweep</option>
                            <option value="BOS" {{ in_array('BOS', $oldTags) ? 'selected' : '' }}>Break of Structure (BOS)</option>
                            <option value="Order Block" {{ in_array('Order Block', $oldTags) ? 'selected' : '' }}>Order Block</option>
                            <option value="Trendline Break" {{ in_array('Trendline Break', $oldTags) ? 'selected' : '' }}>Trendline Break</option>
                            <option value="Support/Resistance" {{ in_array('Support/Resistance', $oldTags) ? 'selected' : '' }}>Support/Resistance</option>
                        </select>
                        <p class="text-[10px] text-black-variant">Hold Ctrl/Cmd to select multiple</p>
                        @error('strategy_tags') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Setup Quality</label>
                            <select name="setup_quality" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm appearance-none">
                                <option value="">Select Quality (Optional)</option>
                                <option value="5" {{ old('setup_quality') == '5' ? 'selected' : '' }}>A+ (Perfect Setup)</option>
                                <option value="4" {{ old('setup_quality') == '4' ? 'selected' : '' }}>A (High Probability)</option>
                                <option value="3" {{ old('setup_quality') == '3' ? 'selected' : '' }}>B (Average)</option>
                                <option value="2" {{ old('setup_quality') == '2' ? 'selected' : '' }}>C (Low Probability)</option>
                                <option value="1" {{ old('setup_quality') == '1' ? 'selected' : '' }}>D (Gambling)</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Dominant Emotion</label>
                            <select name="emotion" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm appearance-none">
                                <option value="">Select Emotion (Optional)</option>
                                <option value="Neutral" {{ old('emotion') == 'Neutral' ? 'selected' : '' }}>Neutral / Focused</option>
                                <option value="Confident" {{ old('emotion') == 'Confident' ? 'selected' : '' }}>Confident</option>
                                <option value="FOMO" {{ old('emotion') == 'FOMO' ? 'selected' : '' }}>FOMO</option>
                                <option value="Revenge" {{ old('emotion') == 'Revenge' ? 'selected' : '' }}>Revenge Trading</option>
                                <option value="Anxious" {{ old('emotion') == 'Anxious' ? 'selected' : '' }}>Anxious / Fearful</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="mistake_flag" value="1" {{ old('mistake_flag') ? 'checked' : '' }} class="w-5 h-5 rounded border-outline-variant/30 bg-surface-container-lowest text-tertiary focus:ring-tertiary/50">
                            <span class="text-sm font-medium text-tertiary group-hover:text-tertiary/80 transition-colors">Flag as Mistake (Broke rules)</span>
                        </label>
                    </div>
                    
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Trade Notes &amp; Psychology</label>
                        <textarea name="emotion_notes" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm resize-none" placeholder="What were you feeling during execution? Did you follow your rules?" rows="4">{{ old('emotion_notes') }}</textarea>
                        @error('emotion_notes') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Chart Screenshot (Optional)</label>
                        <input type="file" name="image_path" accept="image/*" class="w-full bg-surface-container-lowest text-black-variant border border-outline-variant/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/20 file:text-primary hover:file:bg-primary/30 cursor-pointer"/>
                        @error('image_path') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            
            <div class="pt-6 border-t border-surface-container-low flex justify-end gap-4">
                <a href="{{ route('trades.index') }}" class="px-6 py-3 rounded-lg text-sm font-medium text-black-variant hover:text-black border border-outline-variant/30 hover:bg-surface-container-high transition-all">
                    Cancel
                </a>
                <button class="px-8 py-3 rounded-lg text-sm font-bold text-surface-container-highest bg-primary hover:bg-primary-container transition-all shadow-[0_0_20px_rgba(0,212,170,0.3)] flex items-center gap-2" type="submit">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Save Trade
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
