@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-800">&larr; Back</a>
        <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
    </div>
    <div class="space-x-2">
        <a href="{{ route('products.edit', $product) }}"
           class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50">Edit</a>
        <button type="button" x-data
            @click="$dispatch('open-delete-modal', {
                action: '{{ route('products.destroy', $product) }}',
                message: 'Produk ini akan dihapus secara permanen.'
            })"
            class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200">Delete</button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Main Info -->
    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm p-6 space-y-4">
        <div>
            <p class="text-sm text-gray-500 mb-1">Category</p>
            <a href="{{ route('categories.show', $product->category) }}"
               class="text-lg font-medium text-[#E36A6A] hover:underline">
                {{ $product->category->name }}
            </a>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Description</p>
            <p class="text-gray-800">{{ $product->description ?: '-' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Price</p>
            <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Stock</p>
            <p class="text-lg font-medium text-gray-800">{{ $product->stock }} units</p>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="bg-[#FFF2D0] rounded-2xl p-6 h-fit">
        <p class="text-sm text-gray-600 mb-2">Status</p>
        <div class="inline-block px-3 py-1 rounded-full text-sm font-medium
            @if($product->status === 'active')
                bg-green-100 text-green-800
            @else
                bg-gray-100 text-gray-800
            @endif">
            {{ ucfirst($product->status) }}
        </div>

        <hr class="my-4">

        <p class="text-xs text-gray-500">Created</p>
        <p class="text-sm text-gray-700 mb-3">{{ $product->created_at->format('d M Y H:i') }}</p>

        <p class="text-xs text-gray-500">Last Updated</p>
        <p class="text-sm text-gray-700">{{ $product->updated_at->format('d M Y H:i') }}</p>
    </div>
</div>

@include('components.confirm-delete-modal')
@endsection