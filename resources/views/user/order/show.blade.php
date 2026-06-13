@extends('layouts.userbase')

@section('title', 'Order #' . $order->id . ' - ' . config('app.name'))

@section('content')
    <div>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                <p class="text-sm text-gray-500 mt-1">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                @switch($order->status)
                    @case('pending') bg-yellow-100 text-yellow-800 @break
                    @case('processing') bg-blue-100 text-blue-800 @break
                    @case('shipped') bg-purple-100 text-purple-800 @break
                    @case('completed') bg-green-100 text-green-800 @break
                    @case('cancelled') bg-red-100 text-red-800 @break
                    @default bg-gray-100 text-gray-800
                @endswitch
            ">{{ ucfirst($order->status) }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-base font-semibold text-gray-900">Items</h2>
                    </div>
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left px-6 py-3 font-medium text-gray-500">Product</th>
                                <th class="text-center px-6 py-3 font-medium text-gray-500">Quantity</th>
                                <th class="text-right px-6 py-3 font-medium text-gray-500">Price</th>
                                <th class="text-right px-6 py-3 font-medium text-gray-500">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4 text-gray-900">{{ $item->title }}</td>
                                    <td class="px-6 py-4 text-center text-gray-500">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 text-right text-gray-500">${{ number_format($item->price, 2) }}</td>
                                    <td class="px-6 py-4 text-right font-medium text-gray-900">${{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50 border-t border-gray-200">
                                <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-900">Total</td>
                                <td class="px-6 py-4 text-right font-bold text-gray-900">${{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">Shipping Information</h2>
                    <div class="space-y-2 text-sm">
                        <p class="text-gray-900">{{ $order->shipping_name }}</p>
                        <p class="text-gray-500">{{ $order->shipping_address }}</p>
                        <p class="text-gray-500">{{ $order->shipping_phone }}</p>
                        @if ($order->notes)
                            <div class="mt-3 pt-3 border-t border-gray-100">
                                <p class="text-xs font-medium text-gray-400 uppercase mb-1">Notes</p>
                                <p class="text-gray-500">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('user.order.index') }}" class="block text-center px-6 py-2.5 border border-gray-300 text-gray-600 font-medium rounded-lg hover:bg-gray-50 transition text-sm">
                    Back to Orders
                </a>
            </div>
        </div>
    </div>
@endsection
