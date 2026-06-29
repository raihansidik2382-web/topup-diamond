<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Topup Game</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-navy-dark text-[#f5f5f5] antialiased">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="block text-center text-lg font-black uppercase tracking-widest mb-8">
                <span class="text-white">Top</span><span class="text-orange-accent">Up</span> <span class="text-white">Game</span>
            </a>

            <div class="rounded-xl border border-white/5 bg-navy-light p-8">
                <h1 class="text-xl font-black uppercase tracking-[0.15em] mb-6">Masuk</h1>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="block w-full rounded-lg bg-navy-dark border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
                        @error('email')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-muted mb-1 uppercase tracking-wider">Password</label>
                        <input type="password" name="password" id="password" required
                            class="block w-full rounded-lg bg-navy-dark border border-white/5 px-3 py-2 text-sm text-[#f5f5f5] placeholder-muted focus:outline-none focus:border-orange-accent focus:ring-1 focus:ring-orange-accent/30">
                        @error('password')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full rounded-lg bg-orange-accent px-4 py-2 text-sm font-semibold uppercase tracking-wider text-navy-dark hover:bg-white/80 transition-colors">
                        Masuk
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-muted">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-orange-accent hover:text-orange-accent/80">Daftar</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>