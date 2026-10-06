@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Customer</h1>

<div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">
    <form action="{{ route('customers.update', $customer) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">
            @error('phone')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <textarea name="address" rows="3"
                      class="w-full rounded-xl border-gray-300 focus:border-[#E36A6A] focus:ring-[#E36A6A]">{{ old('address', $customer->address) }}</textarea>
            @error('address')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('customers.index') }}"
               class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 rounded-xl bg-[#E36A6A] hover:bg-[#d15757] text-white font-medium">
                Update
            </button>
        </div>
    </form>
</div>
@endsection