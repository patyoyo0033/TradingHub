<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-xl font-semibold text-on-surface mb-2 font-headline">Welcome Back, Trader</h2>
        <p class="text-sm text-on-surface-variant font-body">Access your precision terminal.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Field -->
        <div class="space-y-2 relative group">
            <label class="block text-xs font-medium text-on-surface-variant transition-colors group-focus-within:text-primary font-label" for="email">
                Email Address
            </label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors pointer-events-none" style="font-size: 18px;">mail</span>
                <input class="w-full bg-white border border-outline-variant/30 text-black text-sm rounded-lg block pl-10 p-3 focus:ring-2 focus:ring-primary-container/50 focus:border-primary-container/50 transition-all font-body placeholder-gray-400 outline-none" id="email" name="email" value="{{ old('email') }}" placeholder="trader@example.com" required autofocus autocomplete="username" type="email"/>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-error" />
        </div>

        <!-- Password Field -->
        <div class="space-y-2 relative group">
            <div class="flex justify-between items-center">
                <label class="block text-xs font-medium text-on-surface-variant transition-colors group-focus-within:text-primary font-label" for="password">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-primary hover:text-primary-fixed-dim transition-colors font-label font-medium" href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors pointer-events-none" style="font-size: 18px;">lock</span>
                <input class="w-full bg-white border border-outline-variant/30 text-black text-sm rounded-lg block pl-10 p-3 focus:ring-2 focus:ring-primary-container/50 focus:border-primary-container/50 transition-all font-body placeholder-gray-400 outline-none" id="password" name="password" placeholder="••••••••" required autocomplete="current-password" type="password"/>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-error" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded bg-surface-container-lowest border-outline-variant/30 text-primary focus:ring-primary-container/50" name="remember">
                <span class="ms-2 text-sm text-on-surface-variant group-hover:text-on-surface transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Action Button -->
        <button class="w-full bg-gradient-to-br from-primary to-primary-container text-on-primary-fixed rounded-lg px-5 py-3 text-sm font-semibold hover:from-primary-fixed hover:to-primary transition-all duration-200 active:scale-[0.98] font-body flex justify-center items-center gap-2 mt-8 shadow-[0_4px_14px_rgba(79,70,229,0.3)]" type="submit">
            Login to Terminal
            <span class="material-symbols-outlined text-sm" style="font-size: 16px;">arrow_forward</span>
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-outline-variant/15 text-center">
        <p class="text-sm text-on-surface-variant font-body">
            Don't have an account? 
            @if (Route::has('register'))
                <a class="text-primary font-medium hover:text-primary-fixed-dim transition-colors ml-1" href="{{ route('register') }}">Sign up</a>
            @endif
        </p>
    </div>
</x-guest-layout>
