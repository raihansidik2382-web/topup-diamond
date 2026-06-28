<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name')) - Topup Game</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="{{ route(auth()->user()?->isAdmin() ? 'admin.dashboard' : 'home') }}" class="text-lg font-bold text-indigo-600">Topup Game</a>
                    <div class="hidden sm:flex items-center gap-6 text-sm font-medium">
                        @auth
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.games.index') }}" class="text-gray-600 hover:text-gray-900">Games</a>
                                <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">Produk</a>
                                <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-gray-900">Pesanan</a>
                            @else
                                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Beranda</a>
                                <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-gray-900">Pesananku</a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="flex items-center gap-4 text-sm font-medium">
                    @auth
                        <span class="text-gray-500">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Masuk</a>
                        <a href="{{ route('register') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
