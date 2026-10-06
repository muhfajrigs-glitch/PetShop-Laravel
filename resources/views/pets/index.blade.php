@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Pets</h1>
    <a href="{{ route('pets.create') }}"
       class="bg-[#E36A6A] hover:bg-[#d15757] text-white px-4 py-2 rounded-xl font-medium transition">
        + Add Pet
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-3 rounded-xl mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Search & Filter -->
<div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
    <form action="{{ route('pets.index') }}" method="GET" class="space-y-3 md:space-y-0 md:flex md:gap-3 md:items-end flex-wrap">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama atau species..."
                   class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
        </div>

        <div class="flex-1 min-w-[180px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
            <select name="customer_id"
                    class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
                <option value="">All Customers</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" @selected(request('customer_id') == $customer->id)>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Species</label>
            <select name="species"
                    class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
                <option value="">All Species</option>
                @foreach ($allSpecies as $sp)
                    <option value="{{ $sp }}" @selected(request('species') == $sp)>
                        {{ ucfirst($sp) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 min-w-[120px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
            <select name="gender"
                    class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
                <option value="">All Gender</option>
                @foreach ($allGenders as $g)
                    <option value="{{ $g }}" @selected(request('gender') == $g)>
                        {{ ucfirst($g) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 rounded-xl bg-[#E36A6A] hover:bg-[#d15757] text-white font-medium">
                Filter
            </button>
            <a href="{{ route('pets.index') }}"
               class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-left text-sm">
        <thead class="bg-[#FFF2D0] text-gray-700">
            <tr>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Species</th>
                <th class="px-4 py-3">Gender</th>
                <th class="px-4 py-3">DOB</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pets as $pet)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">{{ $pet->name }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('customers.show', $pet->customer) }}" class="text-[#E36A6A] hover:underline">
                            {{ $pet->customer->name }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ ucfirst($pet->species) }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($pet->gender === 'male')
                                bg-blue-100 text-blue-800
                            @else
                                bg-pink-100 text-pink-800
                            @endif">
                            {{ ucfirst($pet->gender) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ $pet->date_of_birth?->format('d M Y') ?: '-' }}
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('pets.show', $pet) }}" class="text-gray-600 hover:underline">View</a>
                        <a href="{{ route('pets.edit', $pet) }}" class="text-blue-600 hover:underline">Edit</a>
                        <button type="button" x-data
                            @click="$dispatch('open-delete-modal', {
                                action: '{{ route('pets.destroy', $pet) }}',
                                message: 'Pet ini akan dihapus secara permanen.'
                            })"
                            class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                        Belum ada pets.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $pets->links() }}
</div>

@include('components.confirm-delete-modal')
@endsection