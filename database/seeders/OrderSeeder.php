<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::with('game')->get();

        if ($products->isEmpty()) {
            return;
        }

        $orders = [
            ['status' => 'success', 'payment_method' => 'e-wallet'],
            ['status' => 'success', 'payment_method' => 'transfer'],
            ['status' => 'pending', 'payment_method' => 'transfer'],
            ['status' => 'success', 'payment_method' => 'e-wallet'],
            ['status' => 'failed', 'payment_method' => 'convenience_store'],
            ['status' => 'pending', 'payment_method' => 'e-wallet'],
            ['status' => 'success', 'payment_method' => 'transfer'],
            ['status' => 'success', 'payment_method' => 'e-wallet'],
            ['status' => 'pending', 'payment_method' => 'convenience_store'],
            ['status' => 'success', 'payment_method' => 'transfer'],
        ];

        $customers = [
            ['name' => 'Andi Pratama', 'email' => 'andi@example.com'],
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com'],
            ['name' => 'Citra Dewi', 'email' => 'citra@example.com'],
            ['name' => 'Dian Permata', 'email' => 'dian@example.com'],
            ['name' => 'Eko Saputra', 'email' => 'eko@example.com'],
        ];

        foreach ($orders as $i => $orderData) {
            $product = $products->random();
            $customer = $customers[$i % count($customers)];

            $order = new Order;
            $order->game_id = $product->game_id;
            $order->product_id = $product->id;
            $order->customer_name = $customer['name'];
            $order->customer_email = $customer['email'];
            $order->player_id = (string) fake()->unique()->randomNumber(8);
            $order->server_id = fake()->optional(0.7)->randomNumber(4);
            $order->amount = $product->price;
            $order->status = $orderData['status'];
            $order->payment_method = $orderData['payment_method'];
            $order->save();
        }
    }
}
