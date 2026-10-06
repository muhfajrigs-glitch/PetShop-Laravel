@props(['title' => null, 'icon' => null, 'value' => null])

<div class="card">
    <div class="flex items-center justify-between">
        <div>
            @if($title)
                <p class="text-gray-600 text-sm">{{ $title }}</p>
            @endif
            @if($value)
                <p class="text-3xl font-bold text-coral">{{ $value }}</p>
            @endif
        </div>
        @if($icon)
            <div class="text-4xl">{{ $icon }}</div>
        @endif
    </div>
    @if($slot->isNotEmpty())
        <div class="mt-4">
            {{ $slot }}
        </div>
    @endif
</div>