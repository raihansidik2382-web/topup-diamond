<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductPriceController extends Controller
{
    public function index(Game $game): JsonResponse
    {
        $products = Product::where('game_id', $game->id)
            ->where('is_active', true)
            ->get(['id', 'name', 'currency_amount', 'price', 'description']);

        return response()->json([
            'game' => [
                'id' => $game->id,
                'name' => $game->name,
                'icon' => $game->icon,
            ],
            'products' => $products->map(fn (Product $product) => [
                'id' => $product->id,
                'name' => $product->name,
                'currency_amount' => $product->currency_amount,
                'price' => $product->price,
                'price_formatted' => 'Rp '.number_format($product->price, 0, ',', '.'),
                'description' => $product->description,
            ]),
        ]);
    }
}
