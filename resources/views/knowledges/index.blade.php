<x-app-layout>
    @section('page_title', 'Knowledge Base')
    @section('page_description', 'Master market dynamics with the collective intelligence terminal. Review concepts, strategies, and psychological frameworks.')

    <style>
        .shadow-inner-top {
            box-shadow: inset 0 1px 0 0 rgba(218, 226, 253, 0.1);
        }
    </style>

    <div class="flex justify-between items-center mb-8">
        <a href="{{ route('knowledges.create') }}" class="w-full md:w-auto bg-gradient-to-br from-primary to-primary-container text-white px-5 py-2.5 rounded-lg font-medium text-sm hover:shadow-[0_4px_12px_rgba(79,70,229,0.3)] transition-all active:scale-95 flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Add New Knowledge
        </a>
    </div>

    @if($knowledges->isEmpty())
        <div class="text-center py-10 bg-surface-container rounded-xl ring-1 ring-white/5">
            <p class="text-on-surface-variant">No knowledge entries recorded yet.</p>
        </div>
    @else
        <!-- Content Grid (Bento/Glassmorphism Style) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($knowledges as $knowledge)
                <div x-data="{ isZoomed: false }" class="bg-surface-container rounded-xl p-5 relative overflow-hidden group hover:bg-surface-container-high transition-colors duration-300 shadow-[0_12px_32px_rgba(11,19,38,0.4)] ring-1 ring-white/5 shadow-inner-top">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
                                    {{ $knowledge->type === 'mistake' ? 'error' : ($knowledge->type === 'setup' ? 'strategy' : 'lightbulb') }}
                                </span>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider px-2 py-1 rounded {{ $knowledge->type === 'mistake' ? 'bg-error/20 text-error' : ($knowledge->type === 'setup' ? 'bg-secondary/20 text-secondary' : 'bg-primary/20 text-primary') }}">
                                {{ $knowledge->type }}
                            </span>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('knowledges.edit', $knowledge) }}" class="text-on-surface-variant hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('knowledges.destroy', $knowledge) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-on-surface-variant hover:text-error transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-bold text-on-surface mb-2 relative z-10">{{ $knowledge->title }}</h3>
                    
                    @if($knowledge->image_path)
                        <div class="relative z-10 mb-4 cursor-pointer overflow-hidden rounded-lg border border-outline-variant/30" @click="isZoomed = true">
                            <img src="{{ Storage::url($knowledge->image_path) }}" alt="Knowledge Image" class="w-full h-32 object-cover hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined text-white text-3xl">zoom_in</span>
                            </div>
                        </div>
                        
                        <!-- Lightbox Modal -->
                        <div x-show="isZoomed" x-transition.opacity style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 p-4 backdrop-blur-sm" @click="isZoomed = false" @keydown.window.escape="isZoomed = false">
                            <button @click="isZoomed = false" class="absolute top-6 right-6 md:top-10 md:right-10 text-white hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-4xl">close</span>
                            </button>
                            <img src="{{ Storage::url($knowledge->image_path) }}" alt="Knowledge Image Zoomed" class="max-w-full max-h-full rounded-xl shadow-2xl object-contain" @click.stop>
                        </div>
                    @endif

                    <p class="text-sm text-on-surface-variant mb-5 line-clamp-3 relative z-10">{{ $knowledge->content }}</p>
                    
                    <div class="flex flex-wrap gap-2 relative z-10 mt-auto">
                        @if(is_array($knowledge->tags))
                            @foreach($knowledge->tags as $tag)
                                <span class="px-2.5 py-1 text-[10px] uppercase tracking-wider font-semibold rounded-full bg-primary-container text-on-primary-container">{{ $tag }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
