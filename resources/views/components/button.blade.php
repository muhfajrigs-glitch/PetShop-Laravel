@props(['variant' => 'primary', 'type' => 'button', 'href' => null])

@php
$baseClasses = 'px-4 py-2 rounded-lg font-medium transition inline-block';
$variants = [
    'primary' => 'bg-coral text-white hover:bg-opacity-90',
    'secondary' => 'bg-soft-yellow text-gray-800 hover:bg-opacity-80',
    'danger' => 'bg-red-500 text-white hover:bg-red-600',
];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses {$variants[$variant]}"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClasses {$variants[$variant]}"]) }}>
        {{ $slot }}
    </button>
@endif