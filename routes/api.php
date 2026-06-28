<?php

use App\Http\Controllers\Api\ProductPriceController;
use Illuminate\Support\Facades\Route;

Route::get('/games/{game}/products', [ProductPriceController::class, 'index']);
