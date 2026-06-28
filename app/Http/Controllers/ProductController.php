<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('game')->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $games = Game::where('is_active', true)->get();

        return view('products.create', compact('games'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'game_id' => ['required', 'exists:games,id'],
            'name' => ['required', 'string', 'max:255'],
            'currency_amount' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        $games = Game::where('is_active', true)->get();

        return view('products.edit', compact('product', 'games'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'game_id' => ['required', 'exists:games,id'],
            'name' => ['required', 'string', 'max:255'],
            'currency_amount' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
