<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IRONRIDGE ACCESS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-black text-white antialiased">

    <!-- Background grid / subtle tactical feel -->
    <div class="fixed inset-0 opacity-10 pointer-events-none"
         style="background-image: linear-gradient(#222 1px, transparent 1px), linear-gradient(to right, #222 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    <!-- Top system label -->
    <div class="absolute top-4 left-6 text-xs tracking-widest text-zinc-500 uppercase">
        Secure System v1.0
    </div>

    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md border border-zinc-800 bg-zinc-900 shadow-2xl">

            <!-- Header -->
            <div class="border-b border-zinc-800 px-6 py-4">
                <h1 class="text-xl font-extrabold tracking-widest uppercase">
                    IronRidge <span class="text-red-600">Access</span>
                </h1>
                <p class="text-xs text-zinc-500 mt-1 tracking-wide uppercase">
                    Authorized Personnel Only
                </p>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="border-t border-zinc-800 px-6 py-3 text-[10px] text-zinc-600 tracking-widest uppercase flex justify-between">
                <span>System Locked</span>
                <span>{{ date('Y') }}</span>
            </div>

        </div>

    </div>

</body>
</html>
