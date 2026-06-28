@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-black uppercase tracking-[0.15em]">Daftar Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="rounded-lg bg-orange-accent px-4 py-2 text-sm font-semibold uppercase tracking-wider text-white hover:bg-orange-accent/80 transition-colors">Tambah Produk</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-white/5 bg-navy-light">
        <table class="min-w-full divide-y divide-white/5 text-sm">
            <thead class="bg-navy-dark">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Game</th>
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-right font-semibold text-muted uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-right font-semibold text-muted uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left font-semibold text-muted uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right font-semibold text-muted uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse ($products as $product)
                    <tr class="hover:bg-navy-dark/50">
                        <td class="px-6 py-4">{{ $product->game->name }}</td>
                        <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-right">{{ number_format($product->currency_amount) }}</td>
                        <td class="px-6 py-4 text-right">{{ $product->formatted_price }} @if ($product->currency === 'USD')<span class="text-xs text-muted ml-1">(USD)</span>@endif</td>
                        <td class="px-6 py-4">
                            @if ($product->is_active)
                                <span class="inline-flex rounded-full bg-green-900/50 border border-green-700 px-2 py-0.5 text-xs font-medium text-green-300">Aktif</span>
                            @else
                                <span class="inline-flex rounded-full bg-red-900/50 border border-red-700 px-2 py-0.5 text-xs font-medium text-red-300">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-orange-accent hover:text-orange-accent/80">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-muted">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection