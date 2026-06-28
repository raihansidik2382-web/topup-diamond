@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="text-center mb-12 pt-8">
        <div class="relative inline-block">
            <div class="absolute -inset-4 bg-gradient-to-r from-purple-600/20 to-blue-600/20 blur-3xl rounded-full"></div>
            <h1 class="relative text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-purple-400 via-blue-400 to-cyan-400 bg-clip-text text-transparent">
                Topup Game Favoritmu!
            </h1>
        </div>
        <p class="mt-4 text-gray-400 text-lg">Pilih game di bawah ini dan tingkatkan pengalaman bermainmu.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
        @forelse ($games as $game)
            <a href="{{ route('games.show', $game) }}"
               class="group flex flex-col items-center gap-4 p-6 bg-slate-800/50 border border-slate-700 rounded-2xl hover:-translate-y-1 hover:scale-105 hover:border-purple-500 transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/10 text-center">
                <img src="{{ asset('images/games/' . $game->icon) }}" alt="{{ $game->name }}" class="size-20 object-contain group-hover:scale-110 transition-transform duration-300">
                <div>
                    <h2 class="text-base font-bold text-white">{{ $game->name }}</h2>
                    <p class="text-sm text-gray-400 mt-1">{{ $game->products_count }} produk tersedia</p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-16 text-gray-500">
                <p class="text-lg">Belum ada game tersedia.</p>
            </div>
        @endforelse
    </div>
@endsection
