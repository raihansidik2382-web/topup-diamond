<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $gamesCount = Game::count();
    $productsCount = Product::count();
    $ordersCount = Order::count();
    $recentOrders = Order::with(['game', 'product'])->latest()->take(5)->get();

    return view('dashboard', compact('gamesCount', 'productsCount', 'ordersCount', 'recentOrders'));
})->name('dashboard');

Route::resource('games', GameController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
