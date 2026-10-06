@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('customers.index') }}" class="text-gray-500 hover:text-gray-800">&larr; Back</a>
        <h1 class="text-2xl font-bold text-gray-800">{{ $customer->name }}</h1>
    </div>
    <div class="space-x-2">
        <a href="{{ route('customers.edit', $customer) }}"
           class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50">Edit</a>
        <button type="button" x-data
            @click="$dispatch('open-delete-modal', {
                action: '{{ route('customers.destroy', $customer) }}',
                message: 'Customer dan semua pets-nya akan dihapus secara permanen.'
            })"
            class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200">Delete</button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Main Info -->
    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm p-6 space-y-4">
        <div>
            <p class="text-sm text-gray-500 mb-1">Email</p>
            <p class="text-lg text-gray-800">{{ $customer->email }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Phone</p>
            <p class="text-lg text-gray-800">{{ $customer->phone }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Address</p>
            <p class="text-gray-800">{{ $customer->address }}</p>
        </div>

        <!-- Pets List -->
        <hr class="my-4">
        <div>
            <div class="flex items-center justify-between mb-3">
                <p class="font-semibold text-gray-800">Pets</p>
                <a href="{{ route('pets.create') }}?customer_id={{ $customer->id }}"
                   class="text-sm text-[#E36A6A] hover:underline">+ Add Pet</a>
            </div>

            @if ($customer->pets->count() > 0)
                <div class="space-y-2">
                    @foreach ($customer->pets as $pet)
                        <a href="{{ route('pets.show', $pet) }}"
                           class="block p-3 border border-gray-200 rounded-xl hover:bg-gray-50">
                            <p class="font-medium text-gray-800">{{ $pet->name }}</p>
                            <p class="text-sm text-gray-600">{{ ucfirst($pet->species) }} • {{ ucfirst($pet->gender) }}</p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 italic">Belum ada pets.</p>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div class="bg-[#FFF2D0] rounded-2xl p-6 h-fit">
        <p class="text-sm text-gray-600 mb-2">Stats</p>
        <div class="text-2xl font-bold text-[#E36A6A]">{{ $customer->pets->count() }}</div>
        <p class="text-xs text-gray-500">Total Pets</p>

        <hr class="my-4">

        <p class="text-xs text-gray-500">Created</p>
        <p class="text-sm text-gray-700 mb-3">{{ $customer->created_at->format('d M Y H:i') }}</p>

        <p class="text-xs text-gray-500">Last Updated</p>
        <p class="text-sm text-gray-700">{{ $customer->updated_at->format('d M Y H:i') }}</p>
    </div>
</div>

@include('components.confirm-delete-modal')
@endsection