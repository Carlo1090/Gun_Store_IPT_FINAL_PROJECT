@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
        <p class="text-sm text-gray-400">Update product details and inventory</p>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded-xl">
            ✔ {{ session('success') }}
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-2xl shadow-sm border space-y-5">

        @csrf
        @method('PUT')

        {{-- NAME --}}
        <div>
            <label class="text-sm text-gray-600">Product Name</label>
            <input type="text" name="name"
                   value="{{ $product->name }}"
                   class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-orange-400">
        </div>

        {{-- DESCRIPTION --}}
        <div>
            <label class="text-sm text-gray-600">Description</label>
            <textarea name="description"
                rows="3"
                class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-orange-400">{{ $product->description }}</textarea>
        </div>

        {{-- PRICE + STOCK --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Price</label>
                <input type="number" name="price"
                       value="{{ $product->price }}"
                       class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="text-sm text-gray-600">Stock</label>
                <input type="number" name="stock"
                       value="{{ $product->stock }}"
                       class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-orange-400">
            </div>
        </div>

        {{-- CURRENT IMAGE --}}
        @if($product->image)
        <div>
            <label class="text-sm text-gray-600">Current Image</label>
            <div class="mt-2 w-32 h-32 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden">
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-full h-full object-contain p-2">
            </div>
        </div>
        @endif

        {{-- UPLOAD NEW IMAGE --}}
        <div>
            <label class="text-sm text-gray-600">Change Image</label>
            <input type="file" name="image"
                   class="w-full mt-1 text-sm">
        </div>

        {{-- BUTTONS --}}
        <div class="flex justify-between items-center pt-4">

            <a href="{{ route('products.index') }}"
               class="text-sm text-gray-500 hover:text-gray-800">
                ← Back to Products
            </a>

            <button class="bg-orange-700 hover:bg-orange-800 text-white px-5 py-2 rounded-lg text-sm font-semibold transition">
                Update Product
            </button>

        </div>

    </form>

</div>

@endsection
