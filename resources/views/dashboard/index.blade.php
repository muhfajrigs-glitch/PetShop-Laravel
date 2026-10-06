@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-ink">Dashboard</h1>
        <p class="mt-1 text-ink/70">Selamat datang kembali! Berikut ringkasan data Anda.</p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
        <x-stat-card label="Kategori"  :value="$categoryCount" :route="route('categories.index')" icon="heroicon-o-tag" />
        <x-stat-card label="Produk"    :value="$productCount"  :route="route('products.index')"   icon="heroicon-o-shopping-bag" />
        <x-stat-card label="Pelanggan" :value="$customerCount" :route="route('customers.index')"  icon="heroicon-o-users" />
        <x-stat-card label="Hewan"     :value="$petCount"      :route="route('pets.index')"       icon="heroicon-o-heart" />
    </div>

    <h2 class="mb-4 mt-10 text-2xl font-bold text-ink">Aksi Cepat</h2>
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
        <x-quick-action title="Tambah Kategori"  desc="Buat kategori produk baru"  :route="route('categories.create')" />
        <x-quick-action title="Tambah Produk"    desc="Daftarkan produk baru"      :route="route('products.create')" />
        <x-quick-action title="Tambah Pelanggan" desc="Tambahkan pelanggan baru"   :route="route('customers.create')" />
        <x-quick-action title="Tambah Hewan"     desc="Daftarkan hewan peliharaan" :route="route('pets.create')" />
    </div>

    <div class="mt-10 rounded-2xl border-l-4 border-coral bg-sunny p-6">
        <h3 class="flex items-center gap-2 text-lg font-bold text-ink">
            <x-heroicon-o-light-bulb class="h-6 w-6 text-coral" />
            Tips Penggunaan
        </h3>
        <ul class="mt-4 list-disc space-y-2 pl-5 text-ink/90">
            <li>Kelola kategori produk di menu <strong>Kategori</strong>.</li>
            <li>Tambahkan produk baru dan kelola stok di menu <strong>Produk</strong>.</li>
            <li>Catat data pelanggan di menu <strong>Pelanggan</strong>.</li>
            <li>Simpan data hewan milik pelanggan di menu <strong>Hewan</strong>.</li>
        </ul>
    </div>
@endsection