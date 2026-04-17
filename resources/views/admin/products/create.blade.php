@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Add Product</h1>

    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-2xl shadow-sm border">

        @csrf

        {{-- NAME --}}
        <div class="mb-4">
            <label class="text-sm text-gray-600">Product Name</label>
            <input type="text" name="name"
                   class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-orange-400">
        </div>

        {{-- PRICE --}}
        <div class="mb-4">
            <label class="text-sm text-gray-600">Price</label>
            <input type="number" name="price"
                   class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-orange-400">
        </div>

        {{-- STOCK --}}
        <div class="mb-4">
            <label class="text-sm text-gray-600">Stock</label>
            <input type="number" name="stock"
                   class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-orange-400">
        </div>

        <div class="mb-4">
        <label class="text-sm text-gray-600">Description</label>
        <textarea name="description"
        class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-orange-400"
        rows="3"></textarea>
        </div>

        {{-- IMAGE --}}
        <div class="mb-4">
            <label class="text-sm text-gray-600">Product Image</label>
            <input type="file" name="image"
                   class="w-full mt-1">
        </div>


        {{-- BUTTON --}}
        <button class="bg-orange-700 hover:bg-orange-800 text-white px-4 py-2 rounded-lg w-full">
            Save Product
        </button>

    </form>

</div>

@endsection
