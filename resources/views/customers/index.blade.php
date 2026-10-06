@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Customers</h1>
    <a href="{{ route('customers.create') }}"
       class="bg-[#E36A6A] hover:bg-[#d15757] text-white px-4 py-2 rounded-xl font-medium transition">
        + Add Customer
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-3 rounded-xl mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Search -->
<div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
    <form action="{{ route('customers.index') }}" method="GET" class="flex gap-3 items-end">
        <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama, email, atau telepon..."
                   class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 rounded-xl bg-[#E36A6A] hover:bg-[#d15757] text-white font-medium">
                Search
            </button>
            <a href="{{ route('customers.index') }}"
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
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Phone</th>
                <th class="px-4 py-3">Pets</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">{{ $customer->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $customer->email }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $customer->phone }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $customer->pets_count }} pet(s)
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('customers.show', $customer) }}" class="text-gray-600 hover:underline">View</a>
                        <a href="{{ route('customers.edit', $customer) }}" class="text-blue-600 hover:underline">Edit</a>
                        <button type="button" x-data
                            @click="$dispatch('open-delete-modal', {
                                action: '{{ route('customers.destroy', $customer) }}',
                                message: 'Customer dan semua pets-nya akan dihapus secara permanen.'
                            })"
                            class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                        Belum ada customer.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $customers->links() }}
</div>

@include('components.confirm-delete-modal')
@endsection