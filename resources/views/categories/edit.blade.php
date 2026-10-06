@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Category</h1>

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <h2 class="text-red-800 font-bold mb-2">Validation failed!</h2>
            <ul class="list-disc list-inside text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('categories.update', $category) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

        {{-- NAME FIELD --}}
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input 
                type="text" 
                id="name"
                name="name"
                value="{{ old('name', $category->name) }}"
                class="w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg"
                placeholder="Enter category name"
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- DESCRIPTION FIELD --}}
        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea 
                id="description"
                name="description"
                rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                placeholder="Enter category description"
            >{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- BUTTONS --}}
        <div class="flex gap-4">
            <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Update Category
            </button>
            <a href="{{ route('categories.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection