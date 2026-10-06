@props(['title', 'desc', 'route'])

<a href="{{ $route }}"
   class="group flex items-center justify-between rounded-2xl bg-coral p-6 text-white shadow-sm transition hover:bg-coral-dark hover:shadow-md">
    <div>
        <p class="text-lg font-bold">{{ $title }}</p>
        <p class="mt-1 text-sm text-white/90">{{ $desc }}</p>
    </div>
    <x-heroicon-o-plus class="h-8 w-8 shrink-0 transition group-hover:rotate-90" />
</a>