@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Categories</h1>
    <a href="{{ route('categories.create') }}"
       class="bg-[#E36A6A] hover:bg-[#d15757] text-white px-4 py-2 rounded-xl font-medium transition">
        + Add Category
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-3 rounded-xl mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-[#FFF2D0] text-gray-700">
            <tr>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Description</th>
                <th class="px-4 py-3">Products</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ Str::limit($category->description, 40) ?: '-' }}</td>
                    <td class="px-4 py-3">{{ $category->products_count }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('categories.show', $category) }}" class="text-gray-600 hover:underline">View</a>
                        <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:underline">Edit</a>
                        <button type="button"
                            x-data
                            @click="$dispatch('open-delete-modal', {
                                action: '{{ route('categories.destroy', $category) }}',
                                message: 'Kategori ini memiliki {{ $category->products_count }} produk. Semua produk terkait akan ikut terhapus.'
                            })"
                            class="text-red-600 hover:underline">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-400">
                        Belum ada kategori.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $categories->links() }}
</div>

@include('components.confirm-delete-modal')
@endsection