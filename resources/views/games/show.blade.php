@extends('layouts.app')

@section('title', $game->name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-white transition-colors">&larr; Kembali</a>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="rounded-2xl border border-slate-700 bg-slate-800/50 p-6 md:p-8">
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-700">
                <img src="{{ asset('images/games/' . $game->icon) }}" alt="{{ $game->name }}" class="size-14 object-contain">
                <div>
                    <h1 class="text-xl font-bold text-white">{{ $game->name }}</h1>
                    <p class="text-sm text-gray-400">Pilih produk dan isi data pemain</p>
                </div>
            </div>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}">

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Pilih Produk</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @forelse ($game->products->where('is_active', true) as $product)
                            <label class="relative flex cursor-pointer rounded-xl border border-slate-700 bg-slate-900/50 p-3 hover:border-purple-500 has-[:checked]:border-purple-500 has-[:checked]:bg-purple-900/20 transition-all duration-200">
                                <input type="radio" name="product_id" value="{{ $product->id }}" data-price="{{ $product->price_in_idr }}" class="sr-only peer" required>
                                <div class="w-full text-center">
                                    <div class="text-sm font-semibold text-gray-100">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">{{ $product->formatted_price }}</div>
                                </div>
                            </label>
                        @empty
                            <p class="col-span-full text-sm text-gray-500">Belum ada produk tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Nama</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()?->name) }}" required placeholder="Nama kamu"
                            class="block w-full rounded-lg border border-slate-700 bg-slate-900/50 px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500 focus:ring-1 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()?->email) }}" required placeholder="email@example.com"
                            class="block w-full rounded-lg border border-slate-700 bg-slate-900/50 px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500 focus:ring-1 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">ID Player</label>
                        <input type="text" name="player_id" required placeholder="Masukkan ID game"
                            class="block w-full rounded-lg border border-slate-700 bg-slate-900/50 px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500 focus:ring-1 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Server (opsional)</label>
                        <input type="text" name="server_id" placeholder="ID server"
                            class="block w-full rounded-lg border border-slate-700 bg-slate-900/50 px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:border-purple-500 focus:ring-1 focus:ring-purple-500">
                    </div>
                </div>

                <button type="submit"
                    class="mt-6 w-full rounded-xl bg-gradient-to-r from-purple-600 to-blue-500 px-4 py-3 text-sm font-semibold text-white hover:from-purple-500 hover:to-blue-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all">
                Pesan Sekarang
                </button>
            </form>
        </div>
    </div>
@endsection
