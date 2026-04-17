@extends('layouts.customer')

@section('content')

{{-- PAGE HEADER --}}
<div class="flex items-center justify-between mb-6">
    <h1 class="font-bebas text-3xl tracking-wide">Order History</h1>
    <a href="/shop"
       class="font-condensed text-[11px] font-semibold tracking-widest uppercase px-4 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
        Back to Shop
    </a>
</div>

{{-- SUMMARY STATS --}}
<div class="grid grid-cols-3 gap-3 mb-6">
    <div class="bg-gray-50 rounded-xl p-4">
        <p class="font-condensed text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-1">Total Orders</p>
        <p class="font-bebas text-2xl tracking-wide">{{ $orders->count() }}</p>
    </div>
    <div class="bg-gray-50 rounded-xl p-4">
        <p class="font-condensed text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-1">Total Spent</p>
        <p class="font-bebas text-2xl tracking-wide text-orange-700">
            ₱{{ number_format($orders->sum(fn($o) => $o->product->price * $o->quantity), 0) }}
        </p>
    </div>
    <div class="bg-gray-50 rounded-xl p-4">
        <p class="font-condensed text-[10px] font-semibold tracking-widest uppercase text-gray-400 mb-1">Items Ordered</p>
        <p class="font-bebas text-2xl tracking-wide">{{ $orders->sum('quantity') }}</p>
    </div>
</div>

{{-- ORDERS TABLE --}}
@if($orders->isEmpty())
    <div class="bg-white border border-gray-100 rounded-2xl py-16 text-center">
        <p class="text-gray-400 text-sm mb-3">No orders yet.</p>
        <a href="/shop" class="font-condensed text-[11px] font-semibold tracking-widest uppercase text-orange-700 hover:underline">
            Browse the shop →
        </a>
    </div>
@else
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">

        {{-- TABLE HEAD --}}
        <div class="grid grid-cols-12 px-5 py-3 bg-gray-50 border-b border-gray-100">
            <div class="col-span-5 font-condensed text-[10px] font-semibold tracking-widest uppercase text-gray-400">Product</div>
            <div class="col-span-2 font-condensed text-[10px] font-semibold tracking-widest uppercase text-gray-400">Qty</div>
            <div class="col-span-2 font-condensed text-[10px] font-semibold tracking-widest uppercase text-gray-400">Total</div>
            <div class="col-span-3 font-condensed text-[10px] font-semibold tracking-widest uppercase text-gray-400">Date</div>
        </div>

        {{-- TABLE ROWS --}}
        @foreach($orders as $order)
        <div class="grid grid-cols-12 px-5 py-3.5 border-b border-gray-50 hover:bg-gray-50 transition-colors items-center last:border-b-0">

            {{-- PRODUCT --}}
            <div class="col-span-5 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                    @if($order->product->image)
                        <img src="{{ asset('storage/' . $order->product->image) }}"
                             class="w-9 h-9 rounded-lg object-cover">
                    @else
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 48 48">
                            <rect x="6" y="18" width="28" height="14" rx="2"/>
                            <path d="M34 22h6a2 2 0 012 2v2a2 2 0 01-2 2h-6"/>
                        </svg>
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $order->product->name }}</p>
                    @if($order->product->category)
                        <p class="text-xs text-gray-400">{{ $order->product->category }}</p>
                    @endif
                </div>
            </div>

            {{-- QTY --}}
            <div class="col-span-2">
                <span class="inline-flex items-center justify-center w-7 h-7 rounded-md bg-gray-100 text-sm font-medium text-gray-700">
                    {{ $order->quantity }}
                </span>
            </div>

            {{-- TOTAL --}}
            <div class="col-span-2">
                <span class="font-bebas text-lg tracking-wide text-orange-700">
                    ₱{{ number_format($order->product->price * $order->quantity, 0) }}
                </span>
            </div>

            {{-- DATE --}}
            <div class="col-span-3">
                <p class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $order->created_at->format('h:i A') }}</p>
            </div>

        </div>
        @endforeach

    </div>

    {{-- PAGINATION --}}
    @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">{{ $orders->links() }}</div>
    @endif
@endif

@endsection
