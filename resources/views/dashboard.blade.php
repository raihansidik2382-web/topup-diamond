@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-black uppercase tracking-[0.15em] mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="rounded-xl border border-white/5 bg-navy-light p-6">
            <div class="text-3xl font-bold text-orange-accent">{{ $gamesCount }}</div>
            <div class="mt-1 text-sm text-muted uppercase tracking-wider">Game</div>
            <a href="{{ route('admin.games.index') }}" class="mt-3 inline-block text-sm text-orange-accent hover:text-orange-accent/80">Kelola &rarr;</a>
        </div>

        <div class="rounded-xl border border-white/5 bg-navy-light p-6">
            <div class="text-3xl font-bold text-orange-accent">{{ $productsCount }}</div>
            <div class="mt-1 text-sm text-muted uppercase tracking-wider">Produk Topup</div>
            <a href="{{ route('admin.products.index') }}" class="mt-3 inline-block text-sm text-orange-accent hover:text-orange-accent/80">Kelola &rarr;</a>
        </div>

        <div class="rounded-xl border border-white/5 bg-navy-light p-6">
            <div class="text-3xl font-bold text-orange-accent">{{ $ordersCount }}</div>
            <div class="mt-1 text-sm text-muted uppercase tracking-wider">Pesanan</div>
            <a href="{{ route('admin.orders.index') }}" class="mt-3 inline-block text-sm text-orange-accent hover:text-orange-accent/80">Kelola &rarr;</a>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-lg font-black uppercase tracking-[0.15em] mb-4">Pesanan Terbaru</h2>
        <div class="overflow-hidden rounded-xl border border-white/5 bg-navy-light">
            <table class="min-w-full divide-y divide-white/5 text-sm">
                <thead class="bg-navy-dark">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Game</th>
                        <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right font-semibold text-muted uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($recentOrders as $order)
                        <tr class="hover:bg-navy-dark/50">
                            <td class="px-6 py-4">{{ $order->customer_name }}</td>
                            <td class="px-6 py-4">{{ $order->game->name }}</td>
                            <td class="px-6 py-4">
                                @if ($order->status === 'success')
                                    <span class="inline-flex rounded-full bg-green-900/50 border border-green-700 px-2 py-0.5 text-xs font-medium text-green-300">Sukses</span>
                                @elseif ($order->status === 'pending')
                                    <span class="inline-flex rounded-full bg-yellow-900/50 border border-yellow-700 px-2 py-0.5 text-xs font-medium text-yellow-300">Pending</span>
                                @else
                                    <span class="inline-flex rounded-full bg-red-900/50 border border-red-700 px-2 py-0.5 text-xs font-medium text-red-300">Gagal</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-muted">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection