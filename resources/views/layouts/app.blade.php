<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name')) - Topup Game</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-navy-dark text-[#f5f5f5] antialiased">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-navy-dark/80 backdrop-blur-md border-b border-orange-accent/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-8">
                    <a href="{{ route(auth()->user()?->isAdmin() ? 'admin.dashboard' : 'home') }}" class="text-lg font-black uppercase tracking-widest">
                        <span class="text-white">Top</span><span class="text-orange-accent">Up</span> <span class="text-white">Game</span>
                    </a>
                    <div class="hidden sm:flex items-center gap-6 text-sm font-semibold uppercase tracking-wider">
                        @auth
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-muted hover:text-orange-accent transition-colors">Dashboard</a>
                                <a href="{{ route('admin.games.index') }}" class="text-muted hover:text-orange-accent transition-colors">Games</a>
                                <a href="{{ route('admin.products.index') }}" class="text-muted hover:text-orange-accent transition-colors">Produk</a>
                                <a href="{{ route('admin.orders.index') }}" class="text-muted hover:text-orange-accent transition-colors">Pesanan</a>
                            @else
                                <a href="{{ route('home') }}" class="text-muted hover:text-orange-accent transition-colors">Beranda</a>
                                <a href="{{ route('orders.index') }}" class="text-muted hover:text-orange-accent transition-colors">Pesananku</a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="flex items-center gap-3 text-sm font-medium">
                    @auth
                        <span class="text-muted hidden sm:block">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider text-white bg-orange-accent rounded-lg hover:bg-orange-accent/80 transition-colors">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-muted hover:text-white border border-muted/20 hover:border-orange-accent/50 rounded-lg transition-colors text-sm font-semibold uppercase tracking-wider">Masuk</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-orange-accent text-white rounded-lg hover:bg-orange-accent/80 transition-all text-sm font-semibold uppercase tracking-wider">Daftar</a>
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