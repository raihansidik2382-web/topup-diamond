@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">@auth @if(auth()->user()->isAdmin()) Daftar @endif Pesanan @endauth</h1>
        @auth
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.orders.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Tambah Pesanan</a>
            @endif
        @endauth
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Pelanggan</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Game</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Produk</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Player ID</th>
                    <th class="px-6 py-3 text-right font-medium text-gray-500">Total</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Status</th>
                    @auth
                        @if (auth()->user()->isAdmin())
                            <th class="px-6 py-3 text-right font-medium text-gray-500">Aksi</th>
                        @endif
                    @endauth
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium">{{ $order->customer_name }}</div>
                            <div class="text-gray-500">{{ $order->customer_email }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $order->game->icon }} {{ $order->game->name }}</td>
                        <td class="px-6 py-4">{{ $order->product->name }}</td>
                        <td class="px-6 py-4">{{ $order->player_id }}{{ $order->server_id ? ' ('.$order->server_id.')' : '' }}</td>
                        <td class="px-6 py-4 text-right">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if ($order->status === 'success')
                                <span class="inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">Sukses</span>
                            @elseif ($order->status === 'pending')
                                <span class="inline-flex rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-700">Pending</span>
                            @else
                                <span class="inline-flex rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-700">Gagal</span>
                            @endif
                        </td>
                        @auth
                            @if (auth()->user()->isAdmin())
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.orders.edit', $order) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->check() && auth()->user()->isAdmin() ? 7 : 6 }}" class="px-6 py-12 text-center text-gray-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endsection
