<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Topup Game</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="block text-center text-2xl font-bold text-indigo-600 mb-8">Topup Game</a>

            <div class="rounded-lg border border-gray-200 bg-white p-8">
                <h1 class="text-xl font-semibold mb-6">Masuk</h1>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Masuk
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800">Daftar</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
