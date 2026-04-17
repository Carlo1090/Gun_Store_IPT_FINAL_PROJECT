@extends('layouts.admin')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="font-bebas text-3xl tracking-wide text-gray-900">Orders</h1>
        <p class="text-xs text-gray-400 mt-1">Manage and approve customer orders</p>
    </div>

    <span class="text-xs font-condensed font-semibold tracking-widest uppercase bg-gray-100 text-gray-600 px-2 py-1 rounded">
        {{ $orders->count() }} records
    </span>
</div>

{{-- SUCCESS --}}
@if(session('success'))
    <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded-xl shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M3 8l3.5 3.5L13 4"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

{{-- FILTER --}}
<div class="bg-white border border-gray-100 rounded-2xl p-4 mb-6 shadow-sm">
    <form method="GET" class="flex flex-wrap gap-3 items-center">

        <input type="text" name="search"
            placeholder="Search product..."
            value="{{ request('search') }}"
            class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-orange-500">

        <select name="status"
            class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-orange-500">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
        </select>

        <button class="bg-orange-700 hover:bg-orange-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            Filter
        </button>

    </form>
</div>

{{-- TABLE --}}
<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        {{-- HEAD --}}
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-condensed">
            <tr>
                <th class="p-4 text-left">Customer</th>
                <th class="p-4 text-left">Product</th>
                <th class="p-4 text-left">Qty</th>
                <th class="p-4 text-left">Status</th>
                <th class="p-4 text-left">Action</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody>

        @forelse($orders as $order)
        <tr class="border-t hover:bg-gray-50 transition">

            {{-- CUSTOMER --}}
            <td class="p-4 font-medium text-gray-900">
                {{ $order->user->name }}
            </td>

            {{-- PRODUCT --}}
            <td class="p-4 text-gray-700">
                {{ $order->product->name }}
            </td>

            {{-- QTY --}}
            <td class="p-4 text-gray-600">
                {{ $order->quantity }}
            </td>

            {{-- STATUS --}}
            <td class="p-4">
                @if($order->status === 'pending')
                    <span class="text-[10px] font-condensed font-semibold tracking-wide uppercase bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full">
                        Pending
                    </span>
                @else
                    <span class="text-[10px] font-condensed font-semibold tracking-wide uppercase bg-green-50 text-green-700 px-3 py-1 rounded-full">
                        Approved
                    </span>
                @endif
            </td>

            {{-- ACTION --}}
            <td class="p-4">

                @if($order->status === 'pending')
                    <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                        @csrf

                        <button
                            class="text-[11px] font-condensed tracking-widest uppercase bg-orange-700 hover:bg-orange-800 text-white px-3 py-2 rounded-lg transition">
                            Approve
                        </button>
                    </form>
                @else
                    <span class="text-green-600 text-sm font-semibold">
                        ✔ Completed
                    </span>
                @endif

            </td>

        </tr>

        @empty
        <tr>
            <td colspan="5" class="p-6 text-center text-gray-400">
                No orders found.
            </td>
        </tr>
        @endforelse

        </tbody>

    </table>

</div>

@endsection
