@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Produk</h1>
            <p class="text-gray-600 mt-2">Kelola daftar produk Anda di sini</p>
        </div>
        <a href="{{ route('products.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#E36A6A] to-[#FFB2B2] text-white font-semibold hover:shadow-lg hover:shadow-[#E36A6A]/30 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Product
        </a>
    </div>
</div>

<!-- Success Message -->
@if (session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start gap-3">
        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
    </div>
@endif

<!-- Search & Filter Card -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6">
    <form action="{{ route('products.index') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:gap-4 md:items-end">
        <!-- Search Field -->
        <div class="flex-1">
            <label for="search" class="block text-sm font-semibold text-gray-800 mb-2">Cari Produk</label>
            <input type="text" 
                   id="search"
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Cari nama atau deskripsi produk..."
                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-300 text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#E36A6A] focus:ring-2 focus:ring-[#E36A6A] focus:ring-opacity-20 transition-all">
        </div>

        <!-- Category Filter -->
        <div class="flex-1">
            <label for="category_id" class="block text-sm font-semibold text-gray-800 mb-2">Kategori</label>
            <select id="category_id"
                    name="category_id"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-300 text-gray-800 focus:outline-none focus:border-[#E36A6A] focus:ring-2 focus:ring-[#E36A6A] focus:ring-opacity-20 transition-all">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Filter -->
        <div class="flex-1">
            <label for="status" class="block text-sm font-semibold text-gray-800 mb-2">Status</label>
            <select id="status"
                    name="status"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-300 text-gray-800 focus:outline-none focus:border-[#E36A6A] focus:ring-2 focus:ring-[#E36A6A] focus:ring-opacity-20 transition-all">
                <option value="">Semua Status</option>
                <option value="active" @selected(request('status') == 'active')>Aktif</option>
                <option value="inactive" @selected(request('status') == 'inactive')>Tidak Aktif</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-2">
            <button type="submit" 
                    class="px-6 py-3 rounded-xl bg-[#E36A6A] hover:bg-[#d15757] text-white font-semibold transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Filter
            </button>
            <a href="{{ route('products.index') }}"
               class="px-6 py-3 rounded-xl border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Products Table -->
<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gradient-to-r from-[#FFF2D0] to-[#FFFBF1] text-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">Nama Produk</th>
                    <th class="px-6 py-4 text-left font-semibold">Kategori</th>
                    <th class="px-6 py-4 text-left font-semibold">Harga</th>
                    <th class="px-6 py-4 text-center font-semibold">Stok</th>
                    <th class="px-6 py-4 text-center font-semibold">Status</th>
                    <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-t hover:bg-[#FFFBF1] transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#FFF2D0] text-[#E36A6A]">
                                {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-800 font-semibold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg 
                                @if($product->stock > 10)
                                    bg-green-100 text-green-700
                                @elseif($product->stock > 0)
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif
                                font-semibold text-sm">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                @if($product->status === 'active')
                                    bg-green-100 text-green-700
                                @else
                                    bg-gray-100 text-gray-700
                                @endif">
                                <span class="w-2 h-2 rounded-full mr-2 
                                    @if($product->status === 'active')
                                        bg-green-500
                                    @else
                                        bg-gray-400
                                    @endif"></span>
                                {{ $product->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('products.show', $product) }}" 
                                   class="inline-flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition-colors"
                                   title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat
                                </a>
                                <a href="{{ route('products.edit', $product) }}" 
                                   class="inline-flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium text-blue-600 hover:bg-blue-50 transition-colors"
                                   title="Edit Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <button type="button" 
                                        x-data
                                        @click="$dispatch('open-delete-modal', {
                                            action: '{{ route('products.destroy', $product) }}',
                                            message: 'Produk ini akan dihapus secara permanen.'
                                        })"
                                        class="inline-flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors"
                                        title="Hapus Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-gray-500 font-medium">Belum ada produk</p>
                                <p class="text-gray-400 text-sm mt-1">Mulai dengan menambahkan produk baru</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $products->links() }}
</div>

<!-- Delete Modal Component -->
@include('components.confirm-delete-modal')

@endsection