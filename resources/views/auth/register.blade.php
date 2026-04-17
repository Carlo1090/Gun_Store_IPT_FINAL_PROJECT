<x-guest-layout>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="text-center">
        <h2 class="text-xl font-extrabold tracking-widest uppercase">
            Access <span class="text-red-600">Request</span>
        </h2>
        <p class="text-[10px] text-zinc-500 tracking-widest uppercase mt-1">
            Clearance Registration Protocol
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- NAME -->
        <div>
            <label class="block text-[10px] text-zinc-500 uppercase tracking-widest">
                Full Name
            </label>

            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full mt-1 px-4 py-2 bg-black border border-zinc-700 text-white
                       focus:border-red-600 focus:outline-none
                       placeholder-zinc-600 tracking-wide"
                placeholder="ENTER FULL NAME"
                required autofocus>

            <x-input-error :messages="$errors->get('name')"
                class="text-red-500 mt-1 text-xs tracking-wide" />
        </div>

        <!-- EMAIL -->
        <div>
            <label class="block text-[10px] text-zinc-500 uppercase tracking-widest">
                Email Address
            </label>

            <input type="email" name="email" value="{{ old('email') }}"
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
                placeholder="SET PASSWORD"
                required>

            <x-input-error :messages="$errors->get('password')"
                class="text-red-500 mt-1 text-xs tracking-wide" />
        </div>

        <!-- CONFIRM -->
        <div>
            <label class="block text-[10px] text-zinc-500 uppercase tracking-widest">
                Confirm Password
            </label>

            <input type="password" name="password_confirmation"
                class="w-full mt-1 px-4 py-2 bg-black border border-zinc-700 text-white
                       focus:border-red-600 focus:outline-none
                       placeholder-zinc-600 tracking-wide"
                placeholder="RE-ENTER PASSWORD"
                required>

            <x-input-error :messages="$errors->get('password_confirmation')"
                class="text-red-500 mt-1 text-xs tracking-wide" />
        </div>

        <!-- DIVIDER -->
        <div class="flex items-center gap-3 text-[10px] text-zinc-600 uppercase tracking-widest">
            <div class="flex-1 h-px bg-zinc-800"></div>
            Clearance Form
            <div class="flex-1 h-px bg-zinc-800"></div>
        </div>

        <!-- SUBMIT -->
        <button
            class="w-full bg-red-600 hover:bg-red-700 transition
                   py-2 font-extrabold tracking-widest uppercase
                   border border-red-700 hover:border-red-500">
            Submit Request
        </button>

        <!-- LOGIN LINK -->
        <p class="text-center text-[11px] text-zinc-600 tracking-widest uppercase">
            Already verified?
            <a href="{{ route('login') }}"
               class="text-red-600 hover:text-red-500 transition">
                Authenticate
            </a>
        </p>

    </form>

</div>

</x-guest-layout>
