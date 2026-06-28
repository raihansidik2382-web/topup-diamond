@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold mb-2">Topup Game</h1>
        <p class="text-gray-500">Pilih game yang ingin kamu topup.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($games as $game)
            <a href="{{ route('games.show', $game) }}"
               class="rounded-lg border border-gray-200 bg-white p-6 hover:shadow-md hover:border-indigo-400 transition-all flex flex-col items-center gap-4 text-center">
                <img src="{{ asset('images/games/' . $game->icon) }}" alt="{{ $game->name }}" class="size-16 object-contain">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $game->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">{{ $game->products->count() }} produk tersedia</p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Belum ada game tersedia.
            </div>
        @endforelse
    </div>
@endsection
