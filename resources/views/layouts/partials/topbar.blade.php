<header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-sunny bg-white/80 px-4 backdrop-blur sm:px-6 lg:px-8">
    <button @click="sidebarOpen = true" class="rounded-lg p-2 text-ink hover:bg-sunny lg:hidden" aria-label="Buka menu">
        <x-heroicon-o-bars-3 class="h-6 w-6" />
    </button>

    <div class="hidden lg:block"></div>

    <div class="flex items-center gap-2 text-sm font-medium text-ink">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-sunny text-coral">
            <x-heroicon-o-user class="h-5 w-5" />
        </span>
        <span>{{ auth()->user()->name ?? 'Admin PetShop' }}</span>
    </div>
</header>