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
                    <a href="{{ route('dashboard') }}" class="text-lg font-bold text-indigo-600">Topup Game</a>
                    <div class="hidden sm:flex items-center gap-6 text-sm font-medium">
                        <a href="{{ route('games.index') }}" class="text-gray-600 hover:text-gray-900">Games</a>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">Produk</a>
                        <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-gray-900">Pesanan</a>
                    </div>
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
