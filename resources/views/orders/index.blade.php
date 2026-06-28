@extends('layouts.app')

@section('title', auth()->user()?->isAdmin() ? 'Daftar Pesanan' : 'Pesanan Saya')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-black uppercase tracking-[0.15em]">{{ auth()->user()?->isAdmin() ? 'Daftar Pesanan' : 'Pesanan Saya' }}</h1>
    </div>

    <div class="overflow-hidden rounded-xl border border-white/5 bg-navy-light">
        <table class="min-w-full divide-y divide-white/5 text-sm">
            <thead class="bg-navy-dark">
                <tr>
                    @auth
                        @if (auth()->user()->isAdmin())
                            <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Pelanggan</th>
                        @endif
                    @endauth
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Game</th>
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Player ID</th>
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-right font-semibold text-muted uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Status</th>
                    @auth
                        @if (auth()->user()->isAdmin())
                            <th class="px-6 py-3 text-right font-semibold text-muted uppercase tracking-wider">Aksi</th>
                        @endif
                    @endauth
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse ($orders as $order)
                    <tr class="hover:bg-navy-dark/50">
                        @auth
                            @if (auth()->user()->isAdmin())
                                <td class="px-6 py-4">
                                    <div class="font-medium">{{ $order->customer_name }}</div>
                                    <div class="text-muted text-xs">{{ $order->customer_email }}</div>
                                </td>
                            @endif
                        @endauth
                        <td class="px-6 py-4">{{ $order->game->name }}</td>
                        <td class="px-6 py-4">{{ $order->product->name }}</td>
                        <td class="px-6 py-4">{{ $order->player_id }}{{ $order->server_id ? ' ('.$order->server_id.')' : '' }}</td>
                        <td class="px-6 py-4 text-muted text-xs">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 text-right">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if ($order->status === 'success')
                                <span class="inline-flex rounded-full bg-green-900/50 border border-green-700 px-2 py-0.5 text-xs font-medium text-green-300">Sukses</span>
                            @elseif ($order->status === 'pending')
                                <span class="inline-flex rounded-full bg-yellow-900/50 border border-yellow-700 px-2 py-0.5 text-xs font-medium text-yellow-300">Pending</span>
                            @else
                                <span class="inline-flex rounded-full bg-red-900/50 border border-red-700 px-2 py-0.5 text-xs font-medium text-red-300">Gagal</span>
                            @endif
                        </td>
                        @auth
                            @if (auth()->user()->isAdmin())
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center gap-1.5">
                                        @if ($order->status !== 'success')
                                            <form action="{{ route('admin.orders.status', [$order, 'success']) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="rounded bg-green-900/50 border border-green-700 px-2 py-1 text-xs font-medium text-green-300 hover:bg-green-900/80 transition-colors">Selesai</button>
                                            </form>
                                        @endif
                                        @if ($order->status !== 'pending')
                                            <form action="{{ route('admin.orders.status', [$order, 'pending']) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="rounded bg-yellow-900/50 border border-yellow-700 px-2 py-1 text-xs font-medium text-yellow-300 hover:bg-yellow-900/80 transition-colors">Pending</button>
                                            </form>
                                        @endif
                                        @if ($order->status !== 'failed')
                                            <form action="{{ route('admin.orders.status', [$order, 'failed']) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="rounded bg-red-900/50 border border-red-700 px-2 py-1 text-xs font-medium text-red-300 hover:bg-red-900/80 transition-colors">Batal</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->check() && auth()->user()->isAdmin() ? 8 : 6 }}" class="px-6 py-12 text-center text-muted">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endsection