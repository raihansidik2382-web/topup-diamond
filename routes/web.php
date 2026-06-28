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
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

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
        $recentOrders = Order::with(['game', 'product'])->latest()->take(5)->get();

        return view('dashboard', compact('gamesCount', 'productsCount', 'ordersCount', 'recentOrders'));
    })->name('dashboard');

    Route::resource('games', GameController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->except(['show']);
});

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
