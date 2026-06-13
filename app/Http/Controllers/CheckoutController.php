<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $user = auth()->user();

        return view('pages.checkout.index', compact('cart', 'total', 'user'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $data = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:500',
            'shipping_phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = DB::transaction(function () use ($data, $cart, $total) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'pending',
                'shipping_name' => $data['shipping_name'],
                'shipping_address' => $data['shipping_address'],
                'shipping_phone' => $data['shipping_phone'],
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('checkout.confirmation', ['order' => $order->id]);
    }

    public function confirmation($orderId)
    {
        $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($orderId);

        return view('pages.checkout.confirmation', compact('order'));
    }
}
