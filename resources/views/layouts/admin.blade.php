<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">

<!-- NAVBAR -->
<nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center shadow-sm">

    <!-- LEFT -->
    <div class="flex items-center gap-8">

        <!-- LOGO -->
        <h1 class="font-bebas text-2xl tracking-wide text-gray-900">
            ADMIN PANEL
        </h1>

        <!-- LINKS -->
        <div class="flex gap-4 text-sm font-medium">

            <a href="/admin/dashboard"
               class="px-3 py-2 rounded-lg transition
               {{ request()->is('admin/dashboard') ? 'bg-orange-100 text-orange-700' : 'text-gray-600 hover:bg-gray-100' }}">
                Dashboard
            </a>

            <a href="/admin/products"
               class="px-3 py-2 rounded-lg transition
               {{ request()->is('admin/products*') ? 'bg-orange-100 text-orange-700' : 'text-gray-600 hover:bg-gray-100' }}">
                Products
            </a>

            <a href="/admin/orders"
               class="px-3 py-2 rounded-lg transition
               {{ request()->is('admin/orders*') ? 'bg-orange-100 text-orange-700' : 'text-gray-600 hover:bg-gray-100' }}">
                Orders
            </a>

        </div>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        <!-- USER -->
        <div class="relative">
            <button onclick="toggleDropdown()"
                class="flex items-center gap-2 text-sm text-gray-700 hover:text-black">
                👤 {{ auth()->user()->name }}
                <span class="text-xs text-gray-400">Admin</span>
            </button>

            <!-- DROPDOWN -->
            <div id="dropdownMenu"
                class="hidden absolute right-0 mt-2 w-44 bg-white border border-gray-100 rounded-xl shadow-sm">

                <a href="/profile"
                   class="block px-4 py-2 text-sm hover:bg-gray-50">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>

</nav>

<!-- PAGE CONTENT -->
<div class="p-6">
    @yield('content')
</div>

<!-- SCRIPT -->
<script>
function toggleDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
}

document.addEventListener('click', function(e) {
    const button = document.querySelector('[onclick="toggleDropdown()"]');
    const menu = document.getElementById('dropdownMenu');

    if (!button.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
    }
});
</script>

</body>
</html>
