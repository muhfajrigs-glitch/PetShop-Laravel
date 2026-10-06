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
    class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r-2 border-[#E36A6A]/30 bg-[#FFB2B2] shadow-lg transition-transform duration-200 lg:translate-x-0"
    :class="{ 'translate-x-0': sidebarOpen }">

    {{-- Logo --}}
    <div class="flex h-16 items-center gap-2 border-b-2 border-white/70 px-6">
        <x-heroicon-s-sparkles class="h-7 w-7 text-[#E36A6A]" />
        <span class="text-xl font-bold text-[#3B1F1F]">PetShop</span>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 space-y-2 px-4 py-6">
        <p class="mb-3 px-2 text-xs font-bold uppercase tracking-wider text-[#3B1F1F]/60">Menu Utama</p>

        @foreach ($menus as $menu)
            @php $active = request()->routeIs($menu['match']); @endphp
            <a href="{{ route($menu['route']) }}"
               class="flex items-center gap-3 rounded-xl border-2 px-4 py-3 text-sm font-semibold transition
                      {{ $active
                          ? 'border-[#E36A6A] bg-[#E36A6A] text-white shadow-md'
                          : 'border-white/70 bg-white/50 text-[#3B1F1F] hover:border-white hover:bg-white' }}">
                <x-dynamic-component :component="$menu['icon']" class="h-5 w-5 shrink-0" />
                {{ $menu['label'] }}
            </a>
        @endforeach
    </nav>

    {{-- Tombol keluar --}}
    <div class="border-t-2 border-white/70 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-[#C94F4F] bg-[#E36A6A] px-4 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-[#C94F4F]">
                <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5" />
                Keluar
            </button>
        </form>
    </div>
</aside>