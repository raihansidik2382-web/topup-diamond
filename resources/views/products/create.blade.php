@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h1 class="text-2xl font-black uppercase tracking-[0.15em] mb-6">Tambah Produk Topup</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" class="max-w-lg">
        @csrf

        <div class="mb-4">
            <label for="game_id" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Game</label>
            <select name="game_id" id="game_id" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
                <option value="" class="bg-navy-dark">Pilih Game</option>
                @foreach ($games as $game)
                    <option value="{{ $game->id }}" {{ old('game_id') == $game->id ? 'selected' : '' }} class="bg-navy-dark">{{ $game->name }}</option>
                @endforeach
            </select>
            @error('game_id') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="100 Diamonds" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
            @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="currency_amount" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Jumlah Mata Uang Game</label>
            <input type="number" name="currency_amount" id="currency_amount" value="{{ old('currency_amount') }}" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
            @error('currency_amount') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Harga</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
            @error('price') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="currency" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Mata Uang</label>
            <select name="currency" id="currency" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
                <option value="IDR" {{ old('currency') == 'IDR' ? 'selected' : '' }} class="bg-navy-dark">IDR (Rupiah)</option>
                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }} class="bg-navy-dark">USD (Dolar)</option>
            </select>
            @error('currency') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Deskripsi</label>
            <textarea name="description" id="description" rows="3" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">{{ old('description') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" checked class="rounded border-white/5 bg-navy-light text-orange-accent focus:ring-orange-accent/30">
                <span class="text-sm text-[#f5f5f5]">Aktif</span>
            </label>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-orange-accent px-4 py-2 text-sm font-semibold uppercase tracking-wider text-white hover:bg-orange-accent/80 transition-colors">Simpan</button>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-muted hover:text-[#f5f5f5]">Batal</a>
        </div>
    </form>
@endsection