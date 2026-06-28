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
                'currency' => $product->currency,
                'price_in_idr' => $product->price_in_idr,
                'price_formatted' => $product->formatted_price,
                'description' => $product->description,
            ]),
        ]);
    }
}
