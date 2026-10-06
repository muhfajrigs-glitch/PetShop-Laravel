@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Add Pet</h1>

<div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">
    <form action="{{ route('pets.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
            <select name="customer_id"
                    class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
                <option value="">-- Select Customer --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" @selected(old('customer_id', $customer_id) == $customer->id)>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                <input type="text" name="species" value="{{ old('species') }}" placeholder="e.g., dog, cat, bird"
                       class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
                @error('species')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender"
                        class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
                    <option value="">-- Select Gender --</option>
                    <option value="male" @selected(old('gender') == 'male')>Male</option>
                    <option value="female" @selected(old('gender') == 'female')>Female</option>
                </select>
                @error('gender')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth (Optional)</label>
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                   class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
            @error('date_of_birth')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('pets.index') }}"
               class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 rounded-xl bg-[#E36A6A] hover:bg-[#d15757] text-white font-medium">
                Save
            </button>
        </div>
    </form>
</div>
@endsection