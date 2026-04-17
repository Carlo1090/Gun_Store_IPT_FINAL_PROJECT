@extends('layouts.customer')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">
        Welcome back, {{ auth()->user()->name }} 👋
    </h1>
    <p class="text-sm text-gray-500">
        Overview of your activity and products.
    </p>
</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white p-5 rounded-xl border shadow-sm">
        <p class="text-xs text-gray-400 uppercase">Total Orders</p>
        <h2 class="text-2xl font-bold text-gray-800 mt-1">
            {{ $totalOrders ?? 0 }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-xl border shadow-sm">
        <p class="text-xs text-gray-400 uppercase">Pending</p>
        <h2 class="text-2xl font-bold text-yellow-500 mt-1">
            {{ $pendingOrders ?? 0 }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-xl border shadow-sm">
        <p class="text-xs text-gray-400 uppercase">Approved</p>
        <h2 class="text-2xl font-bold text-green-600 mt-1">
            {{ $approvedOrders ?? 0 }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-xl border shadow-sm">
        <p class="text-xs text-gray-400 uppercase">Total Spent</p>
        <h2 class="text-2xl font-bold text-orange-700 mt-1">
            ₱{{ number_format($totalSpent ?? 0, 0) }}
        </h2>
    </div>

</div>

<!-- PRODUCT PREVIEW -->
<div class="bg-white p-5 rounded-xl border shadow-sm mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold">Available Products</h3>
        <a href="/shop" class="text-sm text-orange-700 hover:underline">View All</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($products as $product)
        <div class="border rounded-xl p-3 hover:shadow transition">

            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="h-24 w-full object-cover rounded mb-2">
            @endif

            <h4 class="text-sm font-semibold truncate">
                {{ $product->name }}
            </h4>

            <p class="text-xs text-gray-400">
                ₱{{ number_format($product->price, 0) }}
            </p>

        </div>
        @endforeach
    </div>
</div>

<!-- RECENT ORDERS -->
<div class="bg-white p-5 rounded-xl border shadow-sm">
    <h3 class="font-semibold mb-4">Recent Orders</h3>

    @if(isset($recentOrders) && $recentOrders->count())
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-400 border-b">
                    <th class="pb-2">Product</th>
                    <th class="pb-2">Qty</th>
                    <th class="pb-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="border-b">
                    <td class="py-2">{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>
                        @if($order->status === 'pending')
                            <span class="text-yellow-500">Pending</span>
                        @else
                            <span class="text-green-600">Approved</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-400 text-sm">No recent orders</p>
    @endif
</div>

<br class="mt-8 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
<span class="text-[10px] uppercase tracking-widest bg-red-50 text-red-600 px-2 py-1 rounded">
    Demo Video
</span>
<br></br>
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="font-semibold text-gray-800">🎥 Firearm Demo</h2>
            <p class="text-xs text-gray-400">You can click to watch or Scan the QR CODE!</p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center gap-6">

        <!-- QR CODE -->
        <div class="p-4 bg-gray-50 rounded-xl border">
            <img src="data:image/png;base64, {!! QrCode::size(180)->generate('https://youtu.be/W2Vrc2R1oGU?si=HFBeMrRJ13pcs_jW') !!}
        </div>

        <!-- DESCRIPTION -->
        <div class="text-center md:text-left">
            <p class="text-sm text-gray-600 mb-3">
                Watch how the Firearm works, including it's Rules, Safety, and Firepower.
            </p>

            <a href="https://youtu.be/W2Vrc2R1oGU?si=HFBeMrRJ13pcs_jW"
               target="_blank"
               class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition">
               ▶ Watch Video
            </a>
        </div>

    </div>

</div>

@endsection
