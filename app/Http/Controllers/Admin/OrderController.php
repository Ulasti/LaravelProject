<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items')
            ->latest()
            ->paginate(20);

        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items');

        return view('admin.order.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order->update($data);

        return redirect()->route('admin.order.index')
            ->with('success', 'Order status updated successfully.');
    }
}
