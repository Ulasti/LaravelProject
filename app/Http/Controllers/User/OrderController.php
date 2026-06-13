<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('user.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $order->load('items');

        return view('user.order.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('user.order.show', $order)
            ->with('success', 'Order #' . $order->id . ' has been cancelled.');
    }
}
