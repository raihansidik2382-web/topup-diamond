@extends('layouts.app')

@section('title', 'Edit Game')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Edit Game</h1>

    <form action="{{ route('games.update', $game) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Game</label>
            <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (emoji)</label>
            <input type="text" name="icon" id="icon" value="{{ old('icon', $game->icon) }}" placeholder="🎮" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            @error('icon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $game->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="text-sm text-gray-700">Aktif</span>
            </label>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Simpan</button>
            <a href="{{ route('games.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
        </div>
    </form>
@endsection
