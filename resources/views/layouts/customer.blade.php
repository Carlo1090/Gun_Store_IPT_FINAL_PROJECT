<!DOCTYPE html>
<html lang="en">
<head>
    <title>IronRidge Arms</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500&family=Barlow+Condensed:wght@600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Barlow', sans-serif; }
        .font-bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px; }
        .font-condensed { font-family: 'Barlow Condensed', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

{{-- NAVBAR --}}
<nav class="bg-white border-b border-gray-200 px-6 h-14 flex items-center justify-between sticky top-0 z-50">

    {{-- LEFT --}}
    <div class="flex items-center gap-6">
        <a href="/dashboard" class="flex items-center gap-2 font-bebas text-xl text-gray-900 hover:text-orange-700 transition-colors">
            <span class="inline-block w-2 h-2 rounded-full bg-orange-700"></span>
            IronRidge Arms
        </a>

        <div class="flex items-center gap-1">
            <a href="/shop"
               class="text-sm font-medium px-3 py-1.5 rounded-md transition-colors
                      {{ request()->is('shop*') ? 'bg-orange-50 text-orange-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                Shop
            </a>
            <a href="/orders"
               class="text-sm font-medium px-3 py-1.5 rounded-md transition-colors
                      {{ request()->is('orders*') ? 'bg-orange-50 text-orange-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                My Orders
            </a>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="relative">
        <button onclick="toggleDropdown()" id="userBtn"
            class="flex items-center gap-2 px-3 py-1.5 rounded-md border border-gray-200 text-sm font-medium text-gray-800 hover:bg-gray-50 transition-colors focus:outline-none">
            <div class="w-7 h-7 rounded-full bg-orange-100 text-orange-800 flex items-center justify-center text-xs font-semibold">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            @auth
                {{ auth()->user()->name }}
            @endauth
            <svg class="w-3 h-3 text-gray-400" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M2 4l4 4 4-4"/>
            </svg>
        </button>

        {{-- DROPDOWN --}}
        <div id="dropdownMenu"
            class="hidden absolute right-0 mt-1.5 w-44 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden z-50">

            <p class="text-[10px] font-semibold tracking-widest uppercase text-gray-400 font-condensed px-3.5 pt-2.5 pb-1">Account</p>

            <a href="/profile" class="flex items-center gap-2.5 px-3.5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-3.5 h-3.5 text-gray-400" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="8" cy="5" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                </svg>
                Profile
            </a>

            <a href="/orders" class="flex items-center gap-2.5 px-3.5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-3.5 h-3.5 text-gray-400" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="4" width="12" height="9" rx="1"/><path d="M5 4V3a3 3 0 016 0v1"/>
                </svg>
                My Orders
            </a>

            <div class="border-t border-gray-100 my-0.5"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2.5 px-3.5 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M10 8H2m0 0l3-3M2 8l3 3M6 4V3a1 1 0 011-1h6a1 1 0 011 1v10a1 1 0 01-1 1H7a1 1 0 01-1-1v-1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- SUBBAR --}}
<div class="bg-white border-b border-gray-100 px-6 py-2 flex items-center justify-between">
    <nav class="flex items-center gap-1.5 text-xs text-gray-400">
        <a href="/dashboard" class="hover:text-gray-600 transition-colors">Home</a>
        <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 2l4 4-4 4"/></svg>
        <span class="text-gray-600 font-medium capitalize">{{ request()->segment(1) ?? 'Dashboard' }}</span>
    </nav>
    <span class="font-condensed text-[10px] font-semibold tracking-widest uppercase bg-orange-50 text-orange-800 px-2 py-0.5 rounded">
        Gold Member
    </span>
</div>

{{-- CONTENT --}}
<main class="max-w-7xl mx-auto px-6 py-6">
    @yield('content')
</main>

<script>
function toggleDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
}
document.addEventListener('click', function(e) {
    const menu = document.getElementById('dropdownMenu');
    const btn = document.getElementById('userBtn');
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
    }
});
</script>

</body>
</html>
