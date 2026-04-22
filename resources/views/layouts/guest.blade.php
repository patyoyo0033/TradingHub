<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TradingHub') }}</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background-color: #0b1326; /* surface */
                background-image: 
                    linear-gradient(to right, rgba(70, 69, 85, 0.05) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(70, 69, 85, 0.05) 1px, transparent 1px);
                background-size: 40px 40px;
            }
            
            .ambient-shadow {
                box-shadow: 0 12px 32px rgba(11, 19, 38, 0.4);
            }

            .glass-edge {
                box-shadow: inset 0 0.5px 0 rgba(218, 226, 253, 0.1); /* on-surface 10% */
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center p-4 text-on-surface bg-surface-container-lowest font-body antialiased">
        <!-- Main Container -->
        <main class="w-full max-w-md relative z-10">
            <!-- Logo Area Above Card -->
            <div class="text-center mb-8">
                <a href="/">
                    <h1 class="text-3xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-br from-primary to-primary-container inline-block">
                        TradingHub
                    </h1>
                </a>
            </div>

            <!-- Glassmorphic Card (Yielding to $slot) -->
            <div class="bg-surface-container-highest/60 backdrop-blur-2xl rounded-xl p-8 ambient-shadow border border-outline-variant/15 glass-edge">
                {{ $slot }}
            </div>

            <!-- Minimal Footer Info -->
            <div class="mt-8 text-center text-xs text-on-surface-variant/50 font-label tracking-wide uppercase">
                &copy; {{ date('Y') }} TradingHub Terminal. Secure Connection.
            </div>
        </main>
    </body>
</html>
