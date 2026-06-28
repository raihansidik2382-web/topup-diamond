@extends('layouts.app')

@section('title', $game->name)

@section('content')
    <div class="mb-8">
        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali</a>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100">
                <img src="{{ asset('images/games/' . $game->icon) }}" alt="{{ $game->name }}" class="size-14 object-contain">
                <div>
                    <h1 class="text-xl font-semibold">{{ $game->name }}</h1>
                    <p class="text-sm text-gray-500">Pilih produk dan isi data pemain</p>
                </div>
            </div>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Produk</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @forelse ($game->products->where('is_active', true) as $product)
                            <label class="relative flex cursor-pointer rounded-lg border border-gray-200 p-3 hover:border-indigo-400 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 transition-colors">
                                <input type="radio" name="product_id" value="{{ $product->id }}" data-price="{{ $product->price_in_idr }}" class="sr-only peer" required>
                                <div class="w-full text-center">
                                    <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ $product->formatted_price }}</div>
                                </div>
                            </label>
                        @empty
                            <p class="col-span-full text-sm text-gray-500">Belum ada produk tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()?->name) }}" required placeholder="Nama kamu"
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()?->email) }}" required placeholder="email@example.com"
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
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
    </div>
@endsection
