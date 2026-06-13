@extends('layouts.frontbase')

@section('title', 'Order Confirmed - ' . config('app.name'))

@section('content')
    <div class="text-center py-16 max-w-lg mx-auto">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-check text-2xl text-green-600"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Confirmed!</h1>
        <p class="text-gray-500 mb-2">Thank you for your purchase.</p>
        <p class="text-sm text-gray-400 mb-8">Order #{{ $order->id }} — {{ $order->created_at->format('M j, Y g:i A') }}</p>

        <div class="bg-white border border-gray-200 rounded-lg p-6 text-left mb-8">
            <div class="space-y-3">
                @foreach ($order->items as $item)
                    <div class="flex items-center justify-between text-sm">
                        <div>
                            <p class="text-gray-900">{{ $item->title }}</p>
                            <p class="text-gray-400 text-xs">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                        </div>
                        <p class="text-gray-900 font-medium">${{ number_format($item->total, 2) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between">
                <p class="font-semibold text-gray-900">Total</p>
                <p class="text-lg font-bold text-gray-900">${{ number_format($order->total, 2) }}</p>
            </div>
        </div>

        <div class="space-x-4">
            <a href="{{ route('user.order.index') }}" class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">
                View My Orders
            </a>
            <a href="{{ route('shop') }}" class="inline-block px-6 py-2.5 border border-gray-300 text-gray-600 font-medium rounded-lg hover:bg-gray-50 transition text-sm">
                Continue Shopping
            </a>
        </div>
    </div>
@endsection
