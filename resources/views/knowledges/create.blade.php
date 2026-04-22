<x-app-layout>
    @section('page_title', 'Add Knowledge Entry')
    @section('page_description', 'Document your technical concepts, strategies, and notes.')

    <div class="bg-surface-container-highest/60 backdrop-blur-[30px] rounded-xl p-6 md:p-8 shadow-[0_12px_32px_rgba(11,19,38,0.4)] border-t border-on-surface/10 relative overflow-hidden max-w-3xl mx-auto">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-container/20 rounded-full blur-[80px] pointer-events-none"></div>
        
        <form action="{{ route('knowledges.store') }}" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Title</label>
                    <input name="title" value="{{ old('title') }}" required class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm font-headline" placeholder="e.g. SMC Order Block" type="text"/>
                    @error('title') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Type -->
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Type</label>
                    <select name="type" required class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm appearance-none">
                        <option value="concept" {{ old('type') == 'concept' ? 'selected' : '' }}>Concept</option>
                        <option value="setup" {{ old('type') == 'setup' ? 'selected' : '' }}>Setup / Strategy</option>
                        <option value="mistake" {{ old('type') == 'mistake' ? 'selected' : '' }}>Mistake / Lesson</option>
                    </select>
                    @error('type') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Tags -->
                <div class="space-y-2">
                    <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Tags (Comma separated)</label>
                    <input name="tags" value="{{ old('tags') }}" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm" placeholder="e.g. Concept, Psychology" type="text"/>
                    @error('tags') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Example Trade -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Link Example Trade (Optional)</label>
                    <select name="example_trade_id" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm appearance-none">
                        <option value="">No linked trade</option>
                        @foreach(\App\Models\Trade::where('user_id', auth()->id())->latest('trade_date')->limit(20)->get() as $tradeOption)
                            <option value="{{ $tradeOption->id }}" {{ old('example_trade_id') == $tradeOption->id ? 'selected' : '' }}>
                                {{ $tradeOption->trade_date->format('Y-m-d') }} - {{ $tradeOption->pair }} ({{ $tradeOption->direction }})
                            </option>
                        @endforeach
                    </select>
                    @error('example_trade_id') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Image Upload -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Upload Reference Image (Optional)</label>
                    <input type="file" name="image_path" accept="image/*" class="w-full bg-surface-container-lowest text-black-variant border border-outline-variant/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/20 file:text-primary hover:file:bg-primary/30 cursor-pointer"/>
                    @error('image_path') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Content -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs font-medium text-black-variant uppercase tracking-wider">Content / Notes</label>
                    <textarea name="content" required rows="8" class="w-full bg-surface-container-lowest text-black border border-outline-variant/30 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all text-sm resize-none" placeholder="Write down your technical concepts or notes here...">{{ old('content') }}</textarea>
                    @error('content') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Submit Action -->
            <div class="pt-6 border-t border-surface-container-low flex justify-end gap-4">
                <a href="{{ route('knowledges.index') }}" class="px-6 py-3 rounded-lg text-sm font-medium text-black-variant hover:text-black border border-outline-variant/30 hover:bg-surface-container-high transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 rounded-lg text-sm font-bold text-surface-container-highest bg-primary hover:bg-primary-container transition-all shadow-[0_0_20px_rgba(0,212,170,0.3)] flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Save Knowledge
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
