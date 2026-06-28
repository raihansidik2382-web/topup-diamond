@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <div class="text-3xl font-bold text-indigo-600">{{ $gamesCount }}</div>
            <div class="mt-1 text-sm text-gray-500">Game</div>
            <a href="{{ route('games.index') }}" class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-900">Kelola &rarr;</a>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <div class="text-3xl font-bold text-indigo-600">{{ $productsCount }}</div>
            <div class="mt-1 text-sm text-gray-500">Produk Topup</div>
            <a href="{{ route('products.index') }}" class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-900">Kelola &rarr;</a>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <div class="text-3xl font-bold text-indigo-600">{{ $ordersCount }}</div>
            <div class="mt-1 text-sm text-gray-500">Pesanan</div>
            <a href="{{ route('orders.index') }}" class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-900">Kelola &rarr;</a>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-lg font-semibold mb-4">Pesanan Terbaru</h2>
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Pelanggan</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Game</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right font-medium text-gray-500">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td class="px-6 py-4">{{ $order->customer_name }}</td>
                            <td class="px-6 py-4">{{ $order->game->name }}</td>
                            <td class="px-6 py-4">
                                @if ($order->status === 'success')
                                    <span class="inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">Sukses</span>
                                @elseif ($order->status === 'pending')
                                    <span class="inline-flex rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-700">Pending</span>
                                @else
                                    <span class="inline-flex rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-700">Gagal</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
