<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TradingHub') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .fill-icon {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-body min-h-screen antialiased selection:bg-primary-container selection:text-white flex flex-col md:flex-row">

    <!-- SideNavBar (Desktop) -->
    <nav class="hidden md:flex h-screen w-64 fixed left-0 top-0 bg-[#161f31] flex-col py-8 z-40 shadow-[0_12px_32px_rgba(11,19,38,0.4)]">
        <div class="px-6 mb-10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-container to-primary flex items-center justify-center shadow-lg">
                <span class="material-symbols-outlined text-white" style="font-variation-settings: 'wght' 700;">monitoring</span>
            </div>
            <div>
                <h1 class="font-bold text-lg text-white tracking-tight">TradingHub</h1>
                <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Pro Account</p>
            </div>
        </div>
        
        <div class="flex flex-col flex-1 gap-2 px-2">
            <a class="{{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-[#4f46e5]/20 to-transparent text-[#c3c0ff] border-l-4 border-[#4f46e5]' : 'text-[#c7c4d8] hover:bg-[#1c263d] border-l-4 border-transparent' }} px-4 py-3 flex items-center gap-3 rounded-r-lg group relative overflow-hidden transition-all duration-300" href="{{ route('dashboard') }}">
                @if(request()->routeIs('dashboard')) <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div> @endif
                <span class="material-symbols-outlined {{ request()->routeIs('dashboard') ? 'fill-icon text-primary' : 'text-on-surface-variant' }} text-xl relative z-10">dashboard</span>
                <span class="font-medium text-sm relative z-10">Overview</span>
            </a>
            
            <a class="{{ request()->routeIs('trades.*') ? 'bg-gradient-to-r from-[#4f46e5]/20 to-transparent text-[#c3c0ff] border-l-4 border-[#4f46e5]' : 'text-[#c7c4d8] hover:bg-[#1c263d] border-l-4 border-transparent' }} px-4 py-3 flex items-center gap-3 rounded-lg transition-all duration-300" href="{{ route('trades.index') }}">
                @if(request()->routeIs('trades.*')) <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div> @endif
                <span class="material-symbols-outlined {{ request()->routeIs('trades.*') ? 'fill-icon text-primary' : 'text-on-surface-variant' }} text-xl relative z-10">inventory_2</span>
                <span class="font-medium text-sm relative z-10">Trade History</span>
            </a>
            
            <a class="{{ request()->routeIs('knowledges.*') ? 'bg-gradient-to-r from-[#4f46e5]/20 to-transparent text-[#c3c0ff] border-l-4 border-[#4f46e5]' : 'text-[#c7c4d8] hover:bg-[#1c263d] border-l-4 border-transparent' }} px-4 py-3 flex items-center gap-3 rounded-lg transition-all duration-300" href="{{ route('knowledges.index') }}">
                @if(request()->routeIs('knowledges.*')) <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div> @endif
                <span class="material-symbols-outlined {{ request()->routeIs('knowledges.*') ? 'fill-icon text-primary' : 'text-on-surface-variant' }} text-xl relative z-10">psychology</span>
                <span class="font-medium text-sm relative z-10">Strategy Lab</span>
            </a>
        </div>
        
        <div class="px-6 mt-auto">
            <a href="{{ route('trades.create') }}" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-primary-container text-white py-3 rounded-xl font-medium text-sm shadow-[0_8px_16px_-4px_rgba(79,70,229,0.4)] hover:shadow-[0_12px_24px_-4px_rgba(79,70,229,0.6)] active:scale-95 transition-all duration-300 relative overflow-hidden group">
                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                <span class="relative z-10 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">add</span> Quick Trade
                </span>
            </a>
        </div>
        
        <div class="mt-6 flex flex-col gap-1 px-2 border-t border-white/5 pt-4">
            <a class="text-[#c7c4d8] hover:bg-[#1c263d] px-4 py-2 flex items-center gap-3 rounded-lg transition-all duration-300" href="{{ route('profile.edit') }}">
                <span class="material-symbols-outlined text-on-surface-variant text-lg">settings</span>
                <span class="text-sm">Profile</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-[#c7c4d8] hover:bg-[#1c263d] px-4 py-2 flex items-center gap-3 rounded-lg transition-all duration-300">
                    <span class="material-symbols-outlined text-on-surface-variant text-lg">logout</span>
                    <span class="text-sm">Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- TopAppBar (Mobile & Sticky Header) -->
    <header class="md:hidden flex justify-between items-center w-full px-6 py-3 bg-[#0b1326]/80 backdrop-blur-xl docked full-width top-0 z-50 shadow-[0_12px_32px_rgba(11,19,38,0.4)] sticky">
        <div class="text-xl font-black tracking-tighter text-[#dae2fd] font-headline">TradingHub</div>
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex items-center space-x-6 mr-4">
                <a class="{{ request()->routeIs('dashboard') ? 'text-[#c3c0ff] border-b-2 border-[#4f46e5]' : 'text-[#c7c4d8] hover:text-[#dae2fd]' }} font-bold pb-1 text-sm" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="{{ request()->routeIs('trades.*') ? 'text-[#c3c0ff] border-b-2 border-[#4f46e5]' : 'text-[#c7c4d8] hover:text-[#dae2fd]' }} font-bold pb-1 text-sm" href="{{ route('trades.index') }}">Journal</a>
                <a class="{{ request()->routeIs('knowledges.*') ? 'text-[#c3c0ff] border-b-2 border-[#4f46e5]' : 'text-[#c7c4d8] hover:text-[#dae2fd]' }} font-bold pb-1 text-sm" href="{{ route('knowledges.index') }}">Knowledge</a>
            </div>
            
            <a href="{{ route('profile.edit') }}" class="w-8 h-8 rounded-full bg-primary-container text-white flex items-center justify-center font-bold overflow-hidden ml-2 cursor-pointer relative group">
                {{ substr(Auth::user()->name, 0, 1) }}
            </a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 md:ml-64 p-4 md:p-8 lg:p-10 pb-24 md:pb-10 relative bg-surface-container-lowest min-h-screen">
        
        <!-- Desktop Header Area -->
        <div class="hidden md:flex justify-between items-end mb-10 w-full">
            <div>
                <h2 class="text-3xl font-headline font-bold text-white tracking-tight mb-1">
                    @yield('page_title', 'Dashboard')
                </h2>
                <p class="text-on-surface-variant text-sm font-medium">@yield('page_description', 'Welcome back, ' . Auth::user()->name)</p>
            </div>
            <div class="flex items-center gap-4 bg-surface-container-low px-4 py-2 rounded-xl border border-white/5 shadow-sm">
                <a href="{{ route('profile.edit') }}" class="w-8 h-8 rounded-full bg-primary-container text-white flex items-center justify-center font-bold overflow-hidden border border-outline-variant/30 relative group cursor-pointer">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </a>
            </div>
        </div>

        {{ $slot }}

    </main>

    <!-- BottomNavBar (Mobile) -->
    <nav class="md:hidden fixed bottom-0 w-full rounded-t-xl z-50 bg-[#161f31]/90 backdrop-blur-2xl shadow-[0_-8px_24px_rgba(0,0,0,0.5)] border-t border-[#dae2fd]/10 flex justify-around items-center px-4 py-3">
        <a class="flex flex-col items-center justify-center {{ request()->routeIs('dashboard') ? 'bg-[#4f46e5] text-white rounded-xl scale-110' : 'text-[#c7c4d8] hover:text-[#dae2fd]' }} p-2 font-['JetBrains_Mono'] text-[10px] uppercase tracking-widest active:scale-90 transition-transform" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined mb-1 text-[20px]">grid_view</span>
            <span class="font-bold">Home</span>
        </a>
        <a class="flex flex-col items-center justify-center {{ request()->routeIs('trades.create') ? 'bg-[#4f46e5] text-white rounded-xl scale-110' : 'text-[#c7c4d8] hover:text-[#dae2fd]' }} p-2 font-['JetBrains_Mono'] text-[10px] uppercase tracking-widest active:scale-90 transition-transform" href="{{ route('trades.create') }}">
            <span class="material-symbols-outlined mb-1 text-[20px]">add_box</span>
            <span class="font-medium">Log</span>
        </a>
        <a class="flex flex-col items-center justify-center {{ request()->routeIs('trades.index') && !request()->routeIs('trades.create') ? 'bg-[#4f46e5] text-white rounded-xl scale-110' : 'text-[#c7c4d8] hover:text-[#dae2fd]' }} p-2 font-['JetBrains_Mono'] text-[10px] uppercase tracking-widest active:scale-90 transition-transform" href="{{ route('trades.index') }}">
            <span class="material-symbols-outlined mb-1 text-[20px]">auto_awesome_motion</span>
            <span class="font-medium">History</span>
        </a>
        <a class="flex flex-col items-center justify-center {{ request()->routeIs('knowledges.*') ? 'bg-[#4f46e5] text-white rounded-xl scale-110' : 'text-[#c7c4d8] hover:text-[#dae2fd]' }} p-2 font-['JetBrains_Mono'] text-[10px] uppercase tracking-widest active:scale-90 transition-transform" href="{{ route('knowledges.index') }}">
            <span class="material-symbols-outlined mb-1 text-[20px]">psychology</span>
            <span class="font-medium">Lab</span>
        </a>
    </nav>

</body>
</html>
