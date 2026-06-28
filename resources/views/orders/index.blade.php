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
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Pembayaran</th>
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
                        <td class="px-6 py-4 text-right">{{ $order->product->formatted_price }}</td>
                        <td class="px-6 py-4">
                            @php
                                $methods = [
                                    'transfer_bca' => 'BCA',
                                    'transfer_mandiri' => 'Mandiri',
                                    'gopay' => 'GoPay',
                                    'dana' => 'DANA',
                                    'transfer' => 'Transfer Bank',
                                    'e-wallet' => 'E-Wallet',
                                    'convenience_store' => 'Convenience Store',
                                ];
                            @endphp
                            <span class="inline-flex rounded-full bg-navy-dark border border-white/5 px-2 py-0.5 text-xs font-medium">
                                {{ $methods[$order->payment_method] ?? $order->payment_method ?? '—' }}
                            </span>
                        </td>
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
                                    <form action="{{ route('admin.orders.status', [$order, '__status__']) }}" method="POST" class="inline">
                                        @csrf
                                        <select onchange="var form=this.closest('form'); form.action=form.action.replace('__status__', this.value); form.submit();"
                                            class="rounded-lg bg-navy-dark border px-2.5 py-1.5 text-xs font-medium text-[#f5f5f5] cursor-pointer transition-colors
                                                @if ($order->status === 'success') border-green-700
                                                @elseif ($order->status === 'pending') border-yellow-700
                                                @else border-red-700
                                                @endif
                                                focus:outline-none focus:ring-1 focus:ring-orange-accent/30">
                                            <option value="" disabled selected>— Ubah Status —</option>
                                            <option value="success" {{ $order->status === 'success' ? 'disabled' : '' }}>&#10003; Selesai</option>
                                            <option value="pending" {{ $order->status === 'pending' ? 'disabled' : '' }}>&#9679; Pending</option>
                                            <option value="failed" {{ $order->status === 'failed' ? 'disabled' : '' }}>&#10007; Batal</option>
                                        </select>
                                    </form>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->check() && auth()->user()->isAdmin() ? 9 : 7 }}" class="px-6 py-12 text-center text-muted">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endsection
