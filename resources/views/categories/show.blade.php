@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-gray-800">&larr; Back</a>
        <h1 class="text-2xl font-bold text-gray-800">{{ $category->name }}</h1>
    </div>
    <div class="space-x-2">
        <a href="{{ route('categories.edit', $category) }}"
           class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50">Edit</a>
        <button type="button" x-data
            @click="$dispatch('open-delete-modal', {
                action: '{{ route('categories.destroy', $category) }}',
                message: 'Kategori ini memiliki {{ $category->products->count() }} produk. Semua produk terkait akan ikut terhapus.'
            })"
            class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200">Delete</button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
    <p class="text-sm text-gray-500 mb-1">Description</p>
    <p class="text-gray-800">{{ $category->description ?: '-' }}</p>
</div>

<div class="bg-white rounded-2xl shadow-sm p-6">
    <h2 class="font-semibold text-gray-800 mb-4">Products in this category ({{ $category->products->count() }})</h2>
    @forelse ($category->products as $product)
        <div class="flex justify-between border-b py-2 last:border-b-0">
            <span>{{ $product->name }}</span>
            <span class="text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        </div>
    @empty
        <p class="text-gray-400">Belum ada produk di kategori ini.</p>
    @endforelse
</div>
@endsection