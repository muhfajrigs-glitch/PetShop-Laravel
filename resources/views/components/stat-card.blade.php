@props(['label', 'value', 'route', 'icon'])

<div class="rounded-2xl border-t-4 border-coral bg-white p-6 shadow-sm">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-ink/70">{{ $label }}</p>
            <p class="mt-2 text-4xl font-bold text-ink">{{ $value }}</p>
        </div>
        <span class="flex h-14 w-14 items-center justify-center rounded-xl bg-sunny text-coral">
            <x-dynamic-component :component="$icon" class="h-7 w-7" />
        </span>
    </div>
    <a href="{{ $route }}" class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-coral hover:text-coral-dark">
        Lihat Semua
        <x-heroicon-o-arrow-right class="h-4 w-4" />
    </a>
</div>