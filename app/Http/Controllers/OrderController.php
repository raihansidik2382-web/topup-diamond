<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $query = Order::with(['game', 'product']);

        if (auth()->check() && ! auth()->user()->isAdmin()) {
            $query->where('customer_email', auth()->user()->email);
        }

        $orders = $query->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create(): View
    {
        $games = Game::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();

        return view('orders.create', compact('games', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'game_id' => ['required', 'exists:games,id'],
            'product_id' => ['required', 'exists:products,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'player_id' => ['required', 'string', 'max:255'],
            'server_id' => ['nullable', 'string', 'max:50'],
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $validated['amount'] = $product->price_in_idr;
        $validated['status'] = 'pending';

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat. Silakan tunggu konfirmasi.');
    }

    public function edit(Order $order): View
    {
        $games = Game::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();

        return view('orders.edit', compact('order', 'games', 'products'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'game_id' => ['required', 'exists:games,id'],
            'product_id' => ['required', 'exists:products,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'player_id' => ['required', 'string', 'max:255'],
            'server_id' => ['nullable', 'string', 'max:50'],
            'amount' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:pending,success,failed'],
            'payment_method' => ['nullable', 'string', 'max:100'],
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function updateStatus(Order $order, string $status): RedirectResponse
    {
        if (! in_array($status, ['pending', 'success', 'failed'])) {
            abort(404);
        }

        $order->update(['status' => $status]);

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan diubah ke '.$status.'.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
