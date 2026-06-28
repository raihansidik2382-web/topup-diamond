@extends('layouts.app')

@section('title', $game->name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-sm text-muted hover:text-orange-accent transition-colors">&larr; Kembali</a>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="rounded-xl border border-white/5 bg-navy-light p-6 md:p-8">
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-white/5">
                <img src="{{ asset('images/games/' . $game->icon) }}" alt="{{ $game->name }}" class="size-14 object-contain">
                <div>
                    <h1 class="text-xl font-black uppercase tracking-[0.15em]">{{ $game->name }}</h1>
                    <p class="text-sm text-muted">Pilih produk dan isi data pemain</p>
                </div>
            </div>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}">

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-muted mb-2 uppercase tracking-wider">Pilih Produk</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @forelse ($game->products->where('is_active', true) as $product)
                            <label class="relative flex cursor-pointer rounded-xl border border-white/5 bg-navy-dark p-3 hover:border-orange-accent/50 has-[:checked]:border-orange-accent has-[:checked]:bg-orange-accent/10 transition-all duration-200">
                                <input type="radio" name="product_id" value="{{ $product->id }}" data-price="{{ $product->price_in_idr }}" class="sr-only peer" required>
                                <div class="w-full text-center">
                                    <div class="text-sm font-semibold">{{ $product->name }}</div>
                                    <div class="text-xs text-muted mt-0.5">{{ $product->formatted_price }}</div>
                                </div>
                            </label>
                        @empty
                            <p class="col-span-full text-sm text-muted">Belum ada produk tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Nama</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()?->name) }}" required placeholder="Nama kamu"
                            class="block w-full rounded-lg bg-navy-dark border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Email</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()?->email) }}" required placeholder="email@example.com"
                            class="block w-full rounded-lg bg-navy-dark border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">ID Player</label>
                        <input type="text" name="player_id" required placeholder="Masukkan ID game"
                            class="block w-full rounded-lg bg-navy-dark border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Server (opsional)</label>
                        <input type="text" name="server_id" placeholder="ID server"
                            class="block w-full rounded-lg bg-navy-dark border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-muted mb-2 uppercase tracking-wider">Metode Pembayaran</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="relative flex cursor-pointer rounded-xl border border-white/5 bg-navy-dark p-3 hover:border-orange-accent/50 has-[:checked]:border-orange-accent has-[:checked]:bg-orange-accent/10 transition-all duration-200">
                                <input type="radio" name="payment_method" value="transfer_bca" class="sr-only peer" required>
                                <div class="w-full text-center">
                                    <div class="text-sm font-semibold">Bank Transfer BCA</div>
                                    <div class="text-xs text-muted mt-0.5">Transfer via BCA</div>
                                </div>
                            </label>
                            <label class="relative flex cursor-pointer rounded-xl border border-white/5 bg-navy-dark p-3 hover:border-orange-accent/50 has-[:checked]:border-orange-accent has-[:checked]:bg-orange-accent/10 transition-all duration-200">
                                <input type="radio" name="payment_method" value="transfer_mandiri" class="sr-only peer" required>
                                <div class="w-full text-center">
                                    <div class="text-sm font-semibold">Bank Transfer Mandiri</div>
                                    <div class="text-xs text-muted mt-0.5">Transfer via Mandiri</div>
                                </div>
                            </label>
                            <label class="relative flex cursor-pointer rounded-xl border border-white/5 bg-navy-dark p-3 hover:border-orange-accent/50 has-[:checked]:border-orange-accent has-[:checked]:bg-orange-accent/10 transition-all duration-200">
                                <input type="radio" name="payment_method" value="gopay" class="sr-only peer" required>
                                <div class="w-full text-center">
                                    <div class="text-sm font-semibold">GoPay</div>
                                    <div class="text-xs text-muted mt-0.5">Bayar via GoPay</div>
                                </div>
                            </label>
                            <label class="relative flex cursor-pointer rounded-xl border border-white/5 bg-navy-dark p-3 hover:border-orange-accent/50 has-[:checked]:border-orange-accent has-[:checked]:bg-orange-accent/10 transition-all duration-200">
                                <input type="radio" name="payment_method" value="dana" class="sr-only peer" required>
                                <div class="w-full text-center">
                                    <div class="text-sm font-semibold">DANA</div>
                                    <div class="text-xs text-muted mt-0.5">Bayar via DANA</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="mt-6 w-full rounded-xl bg-orange-accent px-4 py-3 text-sm font-semibold uppercase tracking-wider text-navy-dark hover:bg-white/80 transition-colors">
                    Pesan Sekarang
                </button>
            </form>
        </div>
    </div>
@endsection