@extends('layouts.admin')

@section('content')

{{-- TOAST --}}
@if(session('success'))
<div id="toast"
     class="fixed top-5 right-5 bg-green-500 text-white px-5 py-3 rounded-xl shadow-lg opacity-0 translate-y-2 transition duration-300 z-50">
    {{ session('success') }}
</div>
@endif

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="font-bebas text-3xl tracking-wide text-gray-900">Products</h1>
        <p class="text-xs text-gray-400 mt-1">Manage your inventory</p>
    </div>

    <a href="{{ route('products.create') }}"
       class="bg-orange-700 hover:bg-orange-800 text-white text-sm font-condensed tracking-widest uppercase px-4 py-2 rounded-lg transition">
        + Add Product
    </a>
</div>

{{-- TABLE CARD --}}
<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

<table class="w-full text-sm">

{{-- TABLE HEAD --}}
<thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-condensed">
<tr>
    <th class="p-4 text-left">Product</th>
    <th class="p-4 text-center">Price</th>
    <th class="p-4 text-center">Stock</th>
    <th class="p-4 text-center">Status</th>
    <th class="p-4 text-right">Actions</th>
</tr>
</thead>

{{-- TABLE BODY --}}
<tbody class="divide-y">

@forelse($products as $product)
<tr class="hover:bg-gray-50 transition">

    {{-- PRODUCT INFO --}}
    <td class="p-4 flex items-center gap-4">

        <div class="w-14 h-14 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-full h-full object-cover">
            @else
                <span class="text-gray-300 text-xs">No Img</span>
            @endif
        </div>

        <div>
            <p class="font-medium text-gray-900 text-sm">
                {{ $product->name }}
            </p>

            <p class="text-xs text-gray-400">
                ID: {{ $product->id }}
            </p>
        </div>

    </td>

    {{-- PRICE --}}
    <td class="p-4 text-center font-semibold text-gray-800">
        ₱{{ number_format($product->price, 0) }}
    </td>

    {{-- STOCK --}}
    <td class="p-4 text-center">
        {{ $product->stock }}
    </td>

    {{-- STATUS --}}
    <td class="p-4 text-center">
        @if($product->stock > 0)
            <span class="bg-green-50 text-green-700 text-[10px] font-semibold tracking-widest uppercase px-2 py-1 rounded-full">
                In Stock
            </span>
        @else
            <span class="bg-red-50 text-red-600 text-[10px] font-semibold tracking-widest uppercase px-2 py-1 rounded-full">
                Out
            </span>
        @endif
    </td>

    {{-- ACTIONS --}}
    <td class="p-4 text-right space-x-2">

        <a href="{{ route('products.edit', $product->id) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded-lg transition">
            Edit
        </a>

        <form action="{{ route('products.destroy', $product->id) }}"
              method="POST"
              class="inline">
            @csrf
            @method('DELETE')

            <button
                class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded-lg transition"
                onclick="return confirm('Delete this product?')">
                Delete
            </button>
        </form>

    </td>

</tr>

@empty
<tr>
    <td colspan="5" class="p-6 text-center text-gray-400 text-sm">
        No products found.
    </td>
</tr>
@endforelse

</tbody>
</table>

</div>

{{-- TOAST SCRIPT --}}
<script>
const toast = document.getElementById('toast');

if (toast) {
    setTimeout(() => {
        toast.classList.remove('opacity-0', 'translate-y-2');
    }, 100);

    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-2');
    }, 3000);
}
</script>

@endsection
