@extends('layouts.app')

@section('title', 'Daftar Game')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Daftar Game</h1>
        <a href="{{ route('admin.games.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Tambah Game</a>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Icon</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Nama</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Slug</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Status</th>
                    <th class="px-6 py-3 text-right font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($games as $game)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-xl">{{ $game->icon }}</td>
                        <td class="px-6 py-4 font-medium">{{ $game->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $game->slug }}</td>
                        <td class="px-6 py-4">
                            @if ($game->is_active)
                                <span class="inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">Aktif</span>
                            @else
                                <span class="inline-flex rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-700">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.games.edit', $game) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Yakin ingin menghapus game ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada game.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $games->links() }}
    </div>
@endsection
