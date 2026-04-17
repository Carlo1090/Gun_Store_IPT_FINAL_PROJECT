@extends('layouts.customer')

@section('content')

<h1 class="text-2xl font-bold mb-6">Shop</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($products as $product)
<div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-lg transition group">

    {{-- IMAGE WITH ADVANCED ZOOM --}}
    @if($product->image)
    <div class="zoom-container w-full h-44 bg-gray-50 rounded-lg overflow-hidden mb-3 relative">

        <img src="{{ asset('storage/'.$product->image) }}"
             class="zoom-image absolute top-0 left-0 w-full h-full object-contain p-3 transition duration-300">

    </div>
    @endif

    {{-- INFO --}}
    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>

    <p class="text-gray-600 font-medium">₱{{ number_format($product->price, 0) }}</p>

    <p class="text-sm text-gray-500 mb-2">
        Stock: {{ $product->stock }}
    </p>

    {{-- ORDER FORM --}}
    <form action="{{ route('orders.store') }}" method="POST" class="mt-3">
        @csrf

        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <input type="number"
               name="quantity"
               min="1"
               max="{{ $product->stock }}"
               value="1"
               class="border rounded p-2 w-full mb-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">

        <button class="bg-blue-500 hover:bg-blue-600 transition text-white px-3 py-2 w-full rounded-lg text-sm font-semibold">
            Order
        </button>
    </form>

</div>
@endforeach

</div>


{{-- 🔥 ADVANCED ZOOM SCRIPT --}}
<script>
document.querySelectorAll('.zoom-container').forEach(container => {

    const img = container.querySelector('.zoom-image');

    container.addEventListener('mousemove', (e) => {
        const rect = container.getBoundingClientRect();

        const x = (e.clientX - rect.left) / rect.width;
        const y = (e.clientY - rect.top) / rect.height;

        img.style.transform = `scale(2) translate(${(0.5 - x) * 60}%, ${(0.5 - y) * 60}%)`;
    });

    container.addEventListener('mouseleave', () => {
        img.style.transform = 'scale(1) translate(0,0)';
    });

});
</script>

@endsection
