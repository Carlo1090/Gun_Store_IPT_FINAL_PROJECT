<x-guest-layout>

<div class="space-y-6">

    <!-- Status Message -->
    <x-auth-session-status class="text-green-500 text-xs tracking-widest uppercase" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- EMAIL -->
        <div>
            <label class="block text-[10px] text-zinc-500 uppercase tracking-widest">
                Email Address
            </label>

            <input type="email" name="email"
                class="w-full mt-1 px-4 py-2 bg-black border border-zinc-700 text-white
                       focus:border-red-600 focus:outline-none
                       placeholder-zinc-600 tracking-wide"
                placeholder="ENTER EMAIL"
                required>

            <x-input-error :messages="$errors->get('email')"
                class="text-red-500 mt-1 text-xs tracking-wide" />
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="block text-[10px] text-zinc-500 uppercase tracking-widest">
                Password
            </label>

            <input type="password" name="password"
                class="w-full mt-1 px-4 py-2 bg-black border border-zinc-700 text-white
                       focus:border-red-600 focus:outline-none
                       placeholder-zinc-600 tracking-wide"
                placeholder="••••••••"
                required>

            <x-input-error :messages="$errors->get('password')"
                class="text-red-500 mt-1 text-xs tracking-wide" />
        </div>

        <!-- OPTIONS -->
        <div class="flex items-center justify-between text-[11px] tracking-widest uppercase">

            <label class="flex items-center gap-2 text-zinc-500">
                <input type="checkbox" name="remember"
                    class="bg-black border border-zinc-700 w-3 h-3">
                Remember
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-red-600 hover:text-red-500 transition">
                    Forgot
                </a>
            @endif
        </div>

        <!-- BUTTON -->
        <button
            class="w-full bg-red-600 hover:bg-red-700 transition
                   py-2 font-extrabold tracking-widest uppercase
                   border border-red-700 hover:border-red-500">
            Authenticate
        </button>

        <!-- DIVIDER -->
        <div class="flex items-center gap-3 text-[10px] text-zinc-600 uppercase tracking-widest">
            <div class="flex-1 h-px bg-zinc-800"></div>
            Access Control
            <div class="flex-1 h-px bg-zinc-800"></div>
        </div>

        <!-- REGISTER -->
        <p class="text-center text-[11px] text-zinc-600 tracking-widest uppercase">
            No clearance?
            <a href="{{ route('register') }}"
               class="text-red-600 hover:text-red-500 transition">
                Request Access
            </a>
        </p>

    </form>

</div>

</x-guest-layout>
