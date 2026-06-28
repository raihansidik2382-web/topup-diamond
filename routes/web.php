<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $search = request('search');
    $games = $search ? Game::where('name', 'like', '%'.$search.'%')->get() : Game::all();

    return view('topup', compact('games'));
})->name('home');

Route::get('/games/{game:slug}', function (Game $game) {
    $game->load(['products' => fn ($q) => $q->where('is_active', true)]);

    return view('games.show', compact('game'));
})->name('games.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $gamesCount = Game::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();

        $totalIdr = (int) Order::sum('amount');
        $currency = App::make(CurrencyService::class);
        $totalUsd = $currency->idrToUsd($totalIdr);

        $todayIdr = (int) Order::whereDate('created_at', today())->sum('amount');
        $todayUsd = $currency->idrToUsd($todayIdr);

        $monthIdr = (int) Order::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount');
        $monthUsd = $currency->idrToUsd($monthIdr);

        $completedOrders = Order::where('status', 'success')->count();

        $recentOrders = Order::with(['game', 'product'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'gamesCount', 'productsCount', 'ordersCount',
            'totalIdr', 'totalUsd', 'todayIdr', 'todayUsd',
            'monthIdr', 'monthUsd', 'completedOrders',
            'recentOrders',
        ));
    })->name('dashboard');

    Route::post('orders/{order}/status/{status}', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::resource('games', GameController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->except(['show']);
});

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
