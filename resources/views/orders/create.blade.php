@extends('layouts.app')

@section('title', 'Tambah Pesanan')

@section('content')
    <h1 class="text-2xl font-black uppercase tracking-[0.15em] mb-6">Tambah Pesanan</h1>

    <form action="{{ route('admin.orders.store') }}" method="POST" class="max-w-lg">
        @csrf

        <div class="mb-4">
            <label for="customer_name" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Nama Pelanggan</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
            @error('customer_name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="customer_email" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Email Pelanggan</label>
            <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
            @error('customer_email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

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
            <label for="product_id" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Produk</label>
            <select name="product_id" id="product_id" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
                <option value="" class="bg-navy-dark">Pilih Produk</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }} class="bg-navy-dark">{{ $product->name }} - {{ $product->formatted_price }}</option>
                @endforeach
            </select>
            @error('product_id') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="player_id" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Player ID</label>
            <input type="text" name="player_id" id="player_id" value="{{ old('player_id') }}" placeholder="123456789" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
            @error('player_id') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="server_id" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Server ID (opsional)</label>
            <input type="text" name="server_id" id="server_id" value="{{ old('server_id') }}" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
            @error('server_id') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Total Pembayaran (Rp)</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
            @error('amount') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="payment_method" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
                <option value="" class="bg-navy-dark">Pilih Metode</option>
                <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }} class="bg-navy-dark">Transfer Bank</option>
                <option value="e-wallet" {{ old('payment_method') == 'e-wallet' ? 'selected' : '' }} class="bg-navy-dark">E-Wallet</option>
                <option value="convenience_store" {{ old('payment_method') == 'convenience_store' ? 'selected' : '' }} class="bg-navy-dark">Convenience Store</option>
            </select>
            @error('payment_method') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Status</label>
            <select name="status" id="status" class="block w-full rounded-lg bg-navy-light border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }} class="bg-navy-dark">Pending</option>
                <option value="success" {{ old('status') == 'success' ? 'selected' : '' }} class="bg-navy-dark">Sukses</option>
                <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }} class="bg-navy-dark">Gagal</option>
            </select>
            @error('status') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-orange-accent px-4 py-2 text-sm font-semibold uppercase tracking-wider text-white hover:bg-orange-accent/80 transition-colors">Simpan</button>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-muted hover:text-[#f5f5f5]">Batal</a>
        </div>
    </form>
@endsection