@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Edit Produk Topup</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="game_id" class="block text-sm font-medium text-gray-700 mb-1">Game</label>
            <select name="game_id" id="game_id" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
                <option value="">Pilih Game</option>
                @foreach ($games as $game)
                    <option value="{{ $game->id }}" {{ old('game_id', $product->game_id) == $game->id ? 'selected' : '' }}>{{ $game->icon }} {{ $game->name }}</option>
                @endforeach
            </select>
            @error('game_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="currency_amount" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Mata Uang Game</label>
            <input type="number" name="currency_amount" id="currency_amount" value="{{ old('currency_amount', $product->currency_amount) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
            @error('currency_amount') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
            @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="3" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="text-sm text-gray-700">Aktif</span>
            </label>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Simpan</button>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
        </div>
    </form>
@endsection
