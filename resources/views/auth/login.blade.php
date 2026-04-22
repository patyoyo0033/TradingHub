<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TradingHub') }} - Login</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #0b1326;
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(0, 212, 170, 0.08), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(79, 70, 229, 0.08), transparent 25%);
            font-family: 'Inter', sans-serif;
        }

        /* Smooth Animations */
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }

        .animate-fade-in-up { 
            opacity: 0; 
            animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; 
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 4s ease-in-out infinite; }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-8 text-on-surface antialiased overflow-hidden relative">
    
    <!-- Background grid -->
    <div class="absolute inset-0 z-0 opacity-20 pointer-events-none" style="background-image: linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <!-- Main Card Container (Split Layout) -->
    <main class="w-full max-w-5xl bg-surface-container-highest/40 backdrop-blur-3xl rounded-[2rem] shadow-[0_24px_64px_rgba(0,0,0,0.5)] border border-white/10 flex flex-col md:flex-row overflow-hidden relative z-10 animate-fade-in-up">
        
        <!-- Left Side: Branding / Logo -->
        <div class="w-full md:w-5/12 bg-gradient-to-br from-[#121a2f] to-[#0a0f1c] p-10 flex flex-col justify-center items-center relative overflow-hidden border-r border-white/5 hidden md:flex">
            <!-- Glow behind logo -->
            <div class="absolute w-72 h-72 bg-primary/20 rounded-full blur-[80px] animate-pulse-glow"></div>
            
            <div class="relative z-10 text-center animate-float flex items-center justify-center h-full">
                <img src="{{ asset('images/new_logo.png') }}" alt="TradingHub Logo" class="w-80 h-auto mx-auto drop-shadow-[0_0_30px_rgba(0,212,170,0.4)] object-contain">
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-7/12 p-8 sm:p-12 lg:p-16 flex flex-col justify-center relative">
            
            <div class="max-w-md w-full mx-auto">
                <div class="mb-10 text-center md:text-left animate-fade-in-up delay-100">
                    <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
                    <p class="text-sm text-on-surface-variant">Please enter your details to access the terminal.</p>
                </div>

                <x-auth-session-status class="mb-4 animate-fade-in-up delay-100" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6 animate-fade-in-up delay-200">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-2 group">
                        <label class="block text-xs font-semibold text-on-surface-variant tracking-wide group-focus-within:text-primary transition-colors uppercase" for="email">
                            Email Address
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors pointer-events-none" style="font-size: 20px;">mail</span>
                            <input class="w-full bg-white border border-transparent text-gray-900 text-sm rounded-xl block pl-12 p-3.5 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all shadow-inner outline-none placeholder-gray-400 font-medium" id="email" name="email" value="{{ old('email') }}" placeholder="trader@example.com" required autofocus autocomplete="username" type="email"/>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-error" />
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2 group">
                        <div class="flex justify-between items-center">
                            <label class="block text-xs font-semibold text-on-surface-variant tracking-wide group-focus-within:text-primary transition-colors uppercase" for="password">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-primary hover:text-white transition-colors font-medium" href="{{ route('password.request') }}">Forgot password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors pointer-events-none" style="font-size: 20px;">lock</span>
                            <input class="w-full bg-white border border-transparent text-gray-900 text-sm rounded-xl block pl-12 p-3.5 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all shadow-inner outline-none placeholder-gray-400 font-medium" id="password" name="password" placeholder="••••••••" required autocomplete="current-password" type="password"/>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-error" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" class="rounded bg-surface-container-lowest border-outline-variant/30 text-primary focus:ring-primary/50 w-4 h-4 transition-all" name="remember">
                            <span class="ms-2 text-sm text-on-surface-variant group-hover:text-white transition-colors">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Action Button -->
                    <button class="w-full bg-gradient-to-r from-primary to-primary-container text-[#0b1326] rounded-xl px-5 py-3.5 text-sm font-bold hover:shadow-[0_0_25px_rgba(0,212,170,0.5)] transition-all duration-300 active:scale-[0.98] flex justify-center items-center gap-2 mt-4" type="submit">
                        Login to Terminal
                        <span class="material-symbols-outlined text-sm" style="font-size: 18px; font-weight: 700;">arrow_forward</span>
                    </button>
                </form>

                <!-- Social Login Divider -->
                <div class="mt-8 flex items-center gap-4 animate-fade-in-up delay-300">
                    <div class="h-[1px] flex-1 bg-gradient-to-r from-transparent to-white/10"></div>
                    <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest">Or continue with</span>
                    <div class="h-[1px] flex-1 bg-gradient-to-l from-transparent to-white/10"></div>
                </div>

                <!-- Social Buttons -->
                <div class="mt-6 grid grid-cols-2 gap-4 animate-fade-in-up delay-400">
                    <button class="flex items-center justify-center gap-3 w-full bg-surface-container hover:bg-surface-container-high text-white rounded-xl px-4 py-3 text-sm font-semibold border border-white/5 transition-all duration-300 hover:border-white/20 active:scale-95 group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Google
                    </button>
                    <button class="flex items-center justify-center gap-3 w-full bg-[#1877F2]/10 hover:bg-[#1877F2]/20 text-white rounded-xl px-4 py-3 text-sm font-semibold border border-[#1877F2]/30 transition-all duration-300 hover:border-[#1877F2]/50 active:scale-95 group">
                        <svg class="w-5 h-5 text-[#1877F2] group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </button>
                </div>

                <div class="mt-10 text-center animate-fade-in-up delay-400">
                    <p class="text-sm text-on-surface-variant">
                        Don't have an account? 
                        @if (Route::has('register'))
                            <a class="text-primary font-semibold hover:text-white transition-colors ml-1" href="{{ route('register') }}">Sign up here</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
