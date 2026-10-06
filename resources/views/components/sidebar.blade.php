@php
    $menus = [
        ['label' => 'Dashboard', 'route' => 'dashboard',        'match' => 'dashboard',    'icon' => 'heroicon-o-home'],
        ['label' => 'Kategori',  'route' => 'categories.index', 'match' => 'categories.*', 'icon' => 'heroicon-o-tag'],
        ['label' => 'Produk',    'route' => 'products.index',   'match' => 'products.*',   'icon' => 'heroicon-o-shopping-bag'],
        ['label' => 'Pelanggan', 'route' => 'customers.index',  'match' => 'customers.*',  'icon' => 'heroicon-o-users'],
        ['label' => 'Hewan',     'route' => 'pets.index',       'match' => 'pets.*',       'icon' => 'heroicon-o-heart'],
    ];
@endphp

<aside
    class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col bg-blush transition-transform duration-200 lg:translate-x-0"
    :class="{ 'translate-x-0': sidebarOpen }">

    <div class="flex h-16 items-center gap-2 border-b border-white/40 px-6">
        <x-heroicon-s-sparkles class="h-7 w-7 text-coral" />
        <span class="text-xl font-bold text-ink">PetShop</span>
    </div>

    <nav class="flex-1 space-y-1 px-3 py-6">
        @foreach ($menus as $menu)
            @php $active = request()->routeIs($menu['match']); @endphp
            <a href="{{ route($menu['route']) }}"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold transition
                      {{ $active ? 'bg-coral text-white shadow-sm' : 'text-ink hover:bg-white/50' }}">
                <x-dynamic-component :component="$menu['icon']" class="h-5 w-5 shrink-0" />
                {{ $menu['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="border-t border-white/40 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-coral px-4 py-3 text-sm font-semibold text-white transition hover:bg-coral-dark">
                <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5" />
                Keluar
            </button>
        </form>
    </div>
</aside>