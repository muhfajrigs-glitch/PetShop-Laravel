@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('pets.index') }}" class="text-gray-500 hover:text-gray-800">&larr; Back</a>
        <h1 class="text-2xl font-bold text-gray-800">{{ $pet->name }}</h1>
    </div>
    <div class="space-x-2">
        <a href="{{ route('pets.edit', $pet) }}"
           class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50">Edit</a>
        <button type="button" x-data
            @click="$dispatch('open-delete-modal', {
                action: '{{ route('pets.destroy', $pet) }}',
                message: 'Pet ini akan dihapus secara permanen.'
            })"
            class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200">Delete</button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Main Info -->
    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm p-6 space-y-4">
        <div>
            <p class="text-sm text-gray-500 mb-1">Owner</p>
            <a href="{{ route('customers.show', $pet->customer) }}"
               class="text-lg font-medium text-[#E36A6A] hover:underline">
                {{ $pet->customer->name }}
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">Species</p>
                <p class="text-lg font-medium text-gray-800">{{ ucfirst($pet->species) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Gender</p>
                <div class="inline-block px-3 py-1 rounded-full text-sm font-medium
                    @if($pet->gender === 'male')
                        bg-blue-100 text-blue-800
                    @else
                        bg-pink-100 text-pink-800
                    @endif">
                    {{ ucfirst($pet->gender) }}
                </div>
            </div>
        </div>

        @if ($pet->date_of_birth)
            <div>
                <p class="text-sm text-gray-500 mb-1">Date of Birth</p>
                <p class="text-gray-800">{{ $pet->date_of_birth->format('d F Y') }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    ({{ $pet->date_of_birth->diffInYears(now()) }} years old)
                </p>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="bg-[#FFF2D0] rounded-2xl p-6 h-fit">
        <p class="text-sm text-gray-600 mb-3">Quick Info</p>
        
        <div class="space-y-3 text-sm">
            <div>
                <p class="text-xs text-gray-500">Species</p>
                <p class="font-medium text-gray-800">{{ ucfirst($pet->species) }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">Gender</p>
                <p class="font-medium text-gray-800">{{ ucfirst($pet->gender) }}</p>
            </div>
        </div>

        <hr class="my-4">

        <p class="text-xs text-gray-500">Created</p>
        <p class="text-sm text-gray-700 mb-3">{{ $pet->created_at->format('d M Y H:i') }}</p>

        <p class="text-xs text-gray-500">Last Updated</p>
        <p class="text-sm text-gray-700">{{ $pet->updated_at->format('d M Y H:i') }}</p>
    </div>
</div>

@include('components.confirm-delete-modal')
@endsection