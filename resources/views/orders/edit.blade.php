@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Edit Pesanan</h1>

    <form action="{{ route('orders.update', $order) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $order->customer_name) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
            @error('customer_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email Pelanggan</label>
            <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email', $order->customer_email) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
            @error('customer_email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="game_id" class="block text-sm font-medium text-gray-700 mb-1">Game</label>
            <select name="game_id" id="game_id" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
                <option value="">Pilih Game</option>
                @foreach ($games as $game)
                    <option value="{{ $game->id }}" {{ old('game_id', $order->game_id) == $game->id ? 'selected' : '' }}>{{ $game->icon }} {{ $game->name }}</option>
                @endforeach
            </select>
            @error('game_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Produk</label>
            <select name="product_id" id="product_id" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
                <option value="">Pilih Produk</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}</option>
                @endforeach
            </select>
            @error('product_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="player_id" class="block text-sm font-medium text-gray-700 mb-1">Player ID</label>
            <input type="text" name="player_id" id="player_id" value="{{ old('player_id', $order->player_id) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
            @error('player_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="server_id" class="block text-sm font-medium text-gray-700 mb-1">Server ID (opsional)</label>
            <input type="text" name="server_id" id="server_id" value="{{ old('server_id', $order->server_id) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            @error('server_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Total Pembayaran (Rp)</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount', $order->amount) }}" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
            @error('amount') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                <option value="">Pilih Metode</option>
                <option value="transfer" {{ old('payment_method', $order->payment_method) == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="e-wallet" {{ old('payment_method', $order->payment_method) == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                <option value="convenience_store" {{ old('payment_method', $order->payment_method) == 'convenience_store' ? 'selected' : '' }}>Convenience Store</option>
            </select>
            @error('payment_method') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" required>
                <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="success" {{ old('status', $order->status) == 'success' ? 'selected' : '' }}>Sukses</option>
                <option value="failed" {{ old('status', $order->status) == 'failed' ? 'selected' : '' }}>Gagal</option>
            </select>
            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Simpan</button>
            <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
        </div>
    </form>
@endsection
