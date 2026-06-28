@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold mb-2">Topup Game</h1>
        <p class="text-gray-500">Pilih game, pilih produk langsung, dan isi data pemain.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($games as $game)
            <div class="rounded-lg border border-gray-200 bg-white p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/games/' . $game->icon) }}" alt="{{ $game->name }}" class="size-10 object-contain">
                    <h2 class="text-lg font-semibold">{{ $game->name }}</h2>
                </div>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}">

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Produk</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($game->products->where('is_active', true) as $product)
                                <label class="product-option relative flex cursor-pointer rounded-lg border border-gray-200 p-3 hover:border-indigo-400 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 transition-colors">
                                    <input type="radio" name="product_id" value="{{ $product->id }}" data-price="{{ $product->price_in_idr }}" class="sr-only peer" required>
                                    <div class="w-full text-center">
                                        <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5">{{ $product->formatted_price }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()?->name) }}" required placeholder="Nama kamu"
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()?->email) }}" required placeholder="email@example.com"
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID Player</label>
                        <input type="text" name="player_id" required placeholder="Masukkan ID game"
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Server (opsional)</label>
                        <input type="text" name="server_id" placeholder="ID server"
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    </div>

                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Pesan Sekarang
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Belum ada game tersedia.
            </div>
        @endforelse
    </div>
@endsection
