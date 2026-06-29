<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name')) - TopUp Game</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-navy-dark text-[#f5f5f5] antialiased">

    {{-- Mobile hamburger toggle --}}
    <input type="checkbox" id="sidebar-toggle" class="hidden peer">

    {{-- Mobile overlay --}}
    <label for="sidebar-toggle" class="fixed inset-0 z-30 bg-black/60 hidden peer-checked:block lg:hidden"></label>

    {{-- Mobile hamburger button --}}
    <label for="sidebar-toggle" class="fixed top-4 left-4 z-50 flex lg:hidden items-center justify-center size-10 rounded-lg bg-navy-dark border border-muted/20 cursor-pointer">
        <svg class="size-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </label>

    {{-- Sidebar --}}
    <div class="fixed top-0 left-0 z-40 h-screen w-60 bg-navy-dark border-r border-orange-accent/20 flex flex-col transition-transform duration-300 -translate-x-full peer-checked:translate-x-0 lg:translate-x-0">
        {{-- Logo --}}
        <div class="h-16 flex items-center px-6 border-b border-orange-accent/10">
            <a href="{{ route('home') }}" class="text-lg font-black uppercase tracking-widest">
                <span class="text-white">Top</span><span class="text-orange-accent">Up</span> <span class="text-white">Game</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-6 space-y-1">
            @auth
                @if (auth()->user()->isAdmin())
                    @php
                        $adminMenus = [
                            ['key' => 'dashboard', 'label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                            ['key' => 'games', 'label' => 'Games', 'route' => 'admin.games.index', 'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z'],
                            ['key' => 'products', 'label' => 'Produk', 'route' => 'admin.products.index', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                            ['key' => 'orders', 'label' => 'Pesanan', 'route' => 'admin.orders.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ];
                    @endphp
                    @foreach ($adminMenus as $menu)
                        @php $isActive = request()->routeIs($menu['route']); @endphp
                        <a href="{{ route($menu['route']) }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold uppercase tracking-wider rounded-lg transition-all duration-200
                                  {{ $isActive ? 'bg-navy-light text-orange-accent border-l-2 border-orange-accent rounded-l-none' : 'text-muted hover:text-white hover:bg-navy-light' }}">
                            <svg class="size-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}"/>
                            </svg>
                            <span>{{ $menu['label'] }}</span>
                        </a>
                    @endforeach
                @else
                    @php
                        $userMenus = [
                            ['key' => 'beranda', 'label' => 'Beranda', 'route' => 'home', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                            ['key' => 'pesanan', 'label' => 'Pesanan Saya', 'route' => 'orders.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ];
                    @endphp
                    @foreach ($userMenus as $menu)
                        @php $isActive = request()->routeIs($menu['route']); @endphp
                        <a href="{{ route($menu['route']) }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold uppercase tracking-wider rounded-lg transition-all duration-200
                                  {{ $isActive ? 'bg-navy-light text-orange-accent border-l-2 border-orange-accent rounded-l-none' : 'text-muted hover:text-white hover:bg-navy-light' }}">
                            <svg class="size-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}"/>
                            </svg>
                            <span>{{ $menu['label'] }}</span>
                        </a>
                    @endforeach
                @endif
            @endauth

            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-semibold uppercase tracking-wider rounded-lg text-muted hover:text-orange-accent hover:bg-navy-light transition-all duration-200">
                        <svg class="size-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            @endauth
        </nav>

        {{-- Bottom --}}
        <div class="px-6 py-4 border-t border-orange-accent/10">
            <p class="text-[10px] text-muted uppercase tracking-wider">&copy; 2026 TopUp Game. All rights reserved.</p>
        </div>
    </div>

    {{-- Main content area --}}
    <div class="lg:ml-60">
        {{-- Top bar --}}
        <header class="sticky top-0 z-20 h-16 bg-navy-dark/80 backdrop-blur-md border-b border-white/5 flex items-center px-4 md:px-8 gap-4">
            <div class="flex-1"></div>
            <div class="flex items-center gap-3">
                @auth
                    <span class="text-xs text-muted hidden sm:block">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-1.5 size-8 rounded-lg bg-navy-light border border-muted/20 text-muted hover:text-orange-accent hover:border-orange-accent/50 transition-colors" title="Keluar">
                            <svg class="size-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-navy-dark bg-orange-accent rounded-lg hover:bg-white/80 transition-colors">Masuk</a>
                @endauth
            </div>
        </header>

        {{-- Page content --}}
        <div class="p-4 md:p-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-900/50 border border-green-700 text-green-300 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>