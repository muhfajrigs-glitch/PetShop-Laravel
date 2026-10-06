@props(['id', 'title'])

<div x-show="open_{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
     x-transition x-cloak>
    <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
        <h3 class="text-lg font-bold text-gray-800 mb-4">{{ $title }}</h3>
        {{ $slot }}
    </div>
</div>