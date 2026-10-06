@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Create Product</h1>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <h2 class="text-red-800 font-bold mb-2">Validation failed!</h2>
            <ul class="list-disc list-inside text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
            <select 
                id="category_id"
                name="category_id"
                class="w-full px-3 py-2 border @error('category_id') border-red-500 @else border-gray-300 @enderror rounded-lg"
            >
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input 
                type="text" 
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg"
                placeholder="Enter product name"
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea 
                id="description"
                name="description"
                rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                placeholder="Enter product description"
            >{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
            <input 
                type="number" 
                id="price"
                name="price"
                value="{{ old('price') }}"
                step="0.01"
                min="0"
                class="w-full px-3 py-2 border @error('price') border-red-500 @else border-gray-300 @enderror rounded-lg"
                placeholder="0.00"
            >
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-gray-700 font-bold mb-2">Stock</label>
            <input 
                type="number" 
                id="stock"
                name="stock"
                value="{{ old('stock') }}"
                min="0"
                class="w-full px-3 py-2 border @error('stock') border-red-500 @else border-gray-300 @enderror rounded-lg"
                placeholder="0"
            >
            @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
            <select 
                id="status"
                name="status"
                class="w-full px-3 py-2 border @error('status') border-red-500 @else border-gray-300 @enderror rounded-lg"
            >
                <option value="">-- Select Status --</option>
                <option value="active" @selected(old('status') == 'active')>Active</option>
                <option value="inactive" @selected(old('status') == 'inactive')>Inactive</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Save Product
            </button>
            <a href="{{ route('products.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection