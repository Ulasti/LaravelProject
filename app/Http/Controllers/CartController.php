<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = $this->total();

        return view('pages.cart.index', compact('cart', 'total'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $this->add($product, $request->quantity);

        return redirect()->back()->with('cart_updated', true);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $this->updateQuantity($product->id, $request->quantity);

        return redirect()->back()->with('cart_updated', true);
    }

    public function destroy(Product $product)
    {
        $this->remove($product->id);

        return redirect()->back()->with('cart_updated', true);
    }

    public function clear()
    {
        $this->clearAll();

        return redirect()->back()->with('cart_updated', true);
    }


    private function add(Product $product, int $quantity): void
    {
        $cart = session('cart', []);

        foreach ($cart as &$item) {
            if ($item['product_id'] === $product->id) {
                $item['quantity'] += $quantity;
                session(['cart' => $cart]);
                return;
            }
        }

        $cart[] = [
            'product_id' => $product->id,
            'title' => $product->title,
            'price' => (float) $product->price,
            'image' => $product->image,
            'quantity' => $quantity,
        ];

        session(['cart' => $cart]);
    }

    private function updateQuantity(int $productId, int $quantity): void
    {
        $cart = session('cart', []);

        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        foreach ($cart as &$item) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] = $quantity;
                session(['cart' => $cart]);
                return;
            }
        }
    }

    private function remove(int $productId): void
    {
        $cart = session('cart', []);
        $cart = array_values(array_filter($cart, fn($item) => $item['product_id'] !== $productId));
        session(['cart' => $cart]);
    }

    private function clearAll(): void
    {
        session()->forget('cart');
    }

    public static function total(): float
    {
        $cart = session('cart', []);
        return array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
    }

    public static function count(): int
    {
        return array_sum(array_column(session('cart', []), 'quantity'));
    }
}
