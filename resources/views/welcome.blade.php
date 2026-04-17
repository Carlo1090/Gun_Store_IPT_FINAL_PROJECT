<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IRONRIDGE SYSTEM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white">

<!-- GRID BACKGROUND -->
<div class="fixed inset-0 opacity-10 pointer-events-none"
     style="background-image: linear-gradient(#222 1px, transparent 1px), linear-gradient(to right, #222 1px, transparent 1px); background-size: 40px 40px;">
</div>

<!-- NAVBAR -->
<nav class="flex justify-between items-center px-8 py-4 border-b border-zinc-800 bg-black/80 backdrop-blur">

    <h1 class="text-lg font-extrabold tracking-widest uppercase">
        IronRidge <span class="text-red-600">System</span>
    </h1>

    <div class="space-x-6 text-xs uppercase tracking-widest">
        @auth
            <a href="/dashboard" class="text-zinc-400 hover:text-red-500 transition">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-zinc-400 hover:text-red-500 transition">Authenticate</a>
            <a href="{{ route('register') }}"
               class="border border-red-700 px-4 py-1 text-red-600 hover:bg-red-600 hover:text-white transition">
               Request Access
            </a>
        @endauth
    </div>

</nav>

<!-- HERO -->
<section class="flex flex-col justify-center items-center text-center h-[85vh] px-6">

    <h1 class="text-5xl font-extrabold tracking-widest uppercase mb-6">
        Restricted <span class="text-red-600">Access</span>
    </h1>

    <p class="text-zinc-500 max-w-xl mb-8 text-sm tracking-wide uppercase">
        Secure platform for authorized personnel. All activities are monitored and logged.
    </p>

    <div class="flex gap-4">

        <a href="/products"
           class="bg-red-600 border border-red-700 px-6 py-3 text-xs font-extrabold uppercase tracking-widest
                  hover:bg-red-700 transition">
            Enter System
        </a>

        <a href="{{ route('login') }}"
           class="border border-zinc-700 px-6 py-3 text-xs uppercase tracking-widest
                  hover:border-red-600 hover:text-red-500 transition">
            Authenticate
        </a>

    </div>

</section>

<!-- SYSTEM FEATURES -->
<section class="grid md:grid-cols-3 gap-6 px-8 pb-16 max-w-6xl mx-auto">

    <div class="border border-zinc-800 p-6 bg-zinc-900">
        <h3 class="text-sm font-extrabold tracking-widest uppercase mb-2 text-red-600">
            System Speed
        </h3>
        <p class="text-zinc-500 text-xs uppercase tracking-wide">
            Optimized performance with minimal latency across operations.
        </p>
    </div>

    <div class="border border-zinc-800 p-6 bg-zinc-900">
        <h3 class="text-sm font-extrabold tracking-widest uppercase mb-2 text-red-600">
            Security Layer
        </h3>
        <p class="text-zinc-500 text-xs uppercase tracking-wide">
            Multi-layer authentication and encrypted data channels.
        </p>
    </div>

    <div class="border border-zinc-800 p-6 bg-zinc-900">
        <h3 class="text-sm font-extrabold tracking-widest uppercase mb-2 text-red-600">
            Asset Control
        </h3>
        <p class="text-zinc-500 text-xs uppercase tracking-wide">
            Manage and monitor inventory with full audit tracking.
        </p>
    </div>

</section>

<!-- FOOTER -->
<footer class="border-t border-zinc-800 text-center py-4 text-[10px] text-zinc-600 uppercase tracking-widest">
    IronRidge System • All Actions Logged
</footer>

</body>
</html>
