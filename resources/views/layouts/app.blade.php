<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name')) - Topup Game</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-100 antialiased">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gray-900/80 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-8">
                    <a href="{{ route(auth()->user()?->isAdmin() ? 'admin.dashboard' : 'home') }}" class="text-lg font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">Topup Game</a>
                    <div class="hidden sm:flex items-center gap-6 text-sm font-medium">
                        @auth
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.games.index') }}" class="text-gray-300 hover:text-white transition-colors">Games</a>
                                <a href="{{ route('admin.products.index') }}" class="text-gray-300 hover:text-white transition-colors">Produk</a>
                                <a href="{{ route('admin.orders.index') }}" class="text-gray-300 hover:text-white transition-colors">Pesanan</a>
                            @else
                                <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Beranda</a>
                                <a href="{{ route('orders.index') }}" class="text-gray-300 hover:text-white transition-colors">Pesananku</a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="flex items-center gap-3 text-sm font-medium">
                    @auth
                        <span class="text-gray-400">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-white transition-colors">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-300 hover:text-white border border-gray-700 hover:border-gray-500 rounded-lg transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-500 text-white rounded-lg hover:from-purple-500 hover:to-blue-400 transition-all">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-8">
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-900/50 border border-green-700 text-green-300 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
