<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - TopUp Game</title>
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
            @php
                $menus = [
                    ['key' => 'beranda', 'label' => 'Beranda', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ['key' => 'tentang', 'label' => 'Tentang', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            @endphp

            @foreach ($menus as $menu)
                @php
                    $isActive = $menu['key'] === 'beranda';
                    $href = $menu['key'] === 'dashboard' && auth()->check()
                        ? (auth()->user()->isAdmin() ? route('admin.dashboard') : route('orders.index'))
                        : route('home');
                @endphp
                <a href="{{ $href }}"
                   class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold uppercase tracking-wider rounded-lg transition-all duration-200
                          {{ $isActive ? 'bg-navy-light text-orange-accent border-l-2 border-orange-accent rounded-l-none' : 'text-muted hover:text-white hover:bg-navy-light' }}">
                    <svg class="size-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}"/>
                    </svg>
                    <span>{{ $menu['label'] }}</span>
                </a>
            @endforeach

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
            <div class="flex items-center gap-3 mb-3">
                <a href="#" class="text-muted hover:text-orange-accent transition-colors">
                    <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                </a>
                <a href="#" class="text-muted hover:text-orange-accent transition-colors">
                    <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
                <a href="#" class="text-muted hover:text-orange-accent transition-colors">
                    <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
                <a href="#" class="text-muted hover:text-orange-accent transition-colors">
                    <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                </a>
            </div>
            <p class="text-[10px] text-muted uppercase tracking-wider">&copy; 2026 TopUp Game. All rights reserved.</p>
        </div>
    </div>

    {{-- Main content area --}}
    <div class="lg:ml-60">
        {{-- Top bar --}}
        <header class="sticky top-0 z-20 h-16 bg-navy-dark/80 backdrop-blur-md border-b border-white/5 flex items-center px-4 md:px-8 gap-4">
            {{-- Search --}}
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 size-4 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Cari game favorit kamu..."
                           class="w-full pl-10 pr-4 py-2 text-sm rounded-full bg-navy-light border border-muted/20 text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30 transition-colors uppercase tracking-wider">
                </div>
            </div>

            {{-- User area --}}
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
                    <a href="{{ route('login') }}" class="px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-white bg-orange-accent rounded-lg hover:bg-orange-accent/80 transition-colors">Masuk</a>
                @endauth
            </div>
        </header>

        {{-- Page content --}}
        <div class="p-4 md:p-8 space-y-10">

            {{-- Hero Banner --}}
            <x-hero-banner />

            {{-- Games Populer --}}
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <svg class="size-5 text-orange-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h2 class="text-lg font-black uppercase tracking-[0.15em] text-white">Games Populer</h2>
                </div>
                <div class="h-px w-16 bg-orange-accent mb-6"></div>

                {{-- TODO: ganti data dummy ini nanti dengan data dari API/database --}}
                @php
                    $dummyGames = [
                        ['name' => 'Valorant', 'category' => 'FPS', 'image' => asset('images/games/valorant-cover.jpg')],
                        ['name' => 'Genshin Impact', 'category' => 'RPG', 'image' => asset('images/games/genshin-cover.jpg')],
                        ['name' => 'PUBG Mobile', 'category' => 'Battle Royale', 'image' => asset('images/games/pubg-cover.jpg')],
                        ['name' => 'Mobile Legends', 'category' => 'MOBA', 'image' => asset('images/games/mlbb-cover.jpg')],
                        ['name' => 'Free Fire', 'category' => 'Battle Royale', 'image' => asset('images/games/freefire-cover.jpg')],
                    ];
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-4">
                    @foreach ($dummyGames as $game)
                        <x-game-card :name="$game['name']" :category="$game['category']" :image="$game['image']" />
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</body>
</html>
