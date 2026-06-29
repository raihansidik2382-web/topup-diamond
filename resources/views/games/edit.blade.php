@extends('layouts.app')

@section('title', 'Edit Game')

@section('content')
    <h1 class="text-2xl font-black uppercase tracking-[0.15em] mb-6">Edit Game</h1>

    <form action="{{ route('admin.games.update', $game) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Nama Game</label>
            <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
            @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="icon" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Icon</label>
            <input type="text" name="icon" id="icon" value="{{ old('icon', $game->icon) }}" placeholder="nama-file.png" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
            @error('icon') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="cover" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Cover</label>
            <input type="text" name="cover" id="cover" value="{{ old('cover', $game->cover) }}" placeholder="nama-file-cover.jpg" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
            @error('cover') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $game->is_active) ? 'checked' : '' }} class="rounded border-white/5 bg-navy-light text-orange-accent focus:ring-orange-accent/30">
                <span class="text-sm text-[#f5f5f5]">Aktif</span>
            </label>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-orange-accent px-4 py-2 text-sm font-semibold uppercase tracking-wider text-navy-dark hover:bg-white/80 transition-colors">Simpan</button>
            <a href="{{ route('admin.games.index') }}" class="text-sm text-muted hover:text-[#f5f5f5]">Batal</a>
        </div>
    </form>
@endsection