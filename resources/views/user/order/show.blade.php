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

        @php
            $steps = ['pending', 'processing', 'shipped', 'completed'];
            $currentIndex = array_search($order->status, $steps);
            if ($order->status === 'cancelled') $currentIndex = -1;
        @endphp

        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between max-w-2xl mx-auto">
                @foreach (['Order Received', 'Processing', 'Shipped', 'Delivered'] as $i => $label)
                    @php
                        $done = $currentIndex >= $i;
                        $active = $currentIndex === $i;
                    @endphp
                    <div class="flex flex-col items-center {{ $i < 3 ? 'flex-1' : '' }}">
                        <div class="flex items-center w-full">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold
                                    {{ $done ? 'bg-indigo-600 text-white' : ($currentIndex === -1 ? 'bg-red-100 text-red-500' : 'bg-gray-100 text-gray-400') }}">
                                    @if ($done)
                                        <i class="fas fa-check"></i>
                                    @elseif ($currentIndex === -1)
                                        <i class="fas fa-times"></i>
                                    @else
                                        {{ $i + 1 }}
                                    @endif
                                </div>
                                <p class="mt-2 text-xs font-medium {{ $done ? 'text-indigo-600' : ($currentIndex === -1 ? 'text-red-500' : 'text-gray-400') }}">{{ $label }}</p>
                            </div>
                            @if ($i < 3)
                                <div class="flex-1 h-0.5 mx-2 {{ $currentIndex > $i ? 'bg-indigo-600' : 'bg-gray-200' }}"></div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
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

                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">Tracking</h2>

                    @if (in_array($order->status, ['shipped', 'completed']))
                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase">Tracking Number</p>
                                <p class="text-gray-900 font-mono">MOCK-{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase">Carrier</p>
                                <p class="text-gray-900">MockShip Express</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase">Estimated Delivery</p>
                                <p class="text-gray-900">{{ $order->updated_at->addDays(3)->format('F j, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase">Status</p>
                                <p class="text-green-600 font-medium">In Transit</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <svg viewBox="0 0 400 200" class="w-full" xmlns="http://www.w3.org/2000/svg">
                                <rect width="400" height="200" fill="#f3f4f6" rx="8"/>
                                <path d="M0 100 Q 100 120 150 90 T 250 110 T 350 80" fill="none" stroke="#c7d2fe" stroke-width="40" stroke-linecap="round" opacity="0.4"/>
                                <path d="M0 100 Q 100 120 150 90 T 250 110 T 350 80" fill="none" stroke="#6366f1" stroke-width="2.5" stroke-dasharray="6,4"/>
                                <circle cx="40" cy="95" r="8" fill="#6366f1" stroke="white" stroke-width="2.5"/>
                                <circle cx="360" cy="78" r="8" fill="#10b981" stroke="white" stroke-width="2.5"/>
                                <circle cx="200" cy="102" r="4" fill="#6366f1" opacity="0.6"/>
                                <text x="40" y="130" text-anchor="middle" fill="#4f46e5" font-size="9" font-weight="600">Warehouse</text>
                                <text x="360" y="118" text-anchor="middle" fill="#059669" font-size="9" font-weight="600">Destination</text>
                                <text x="200" y="130" text-anchor="middle" fill="#9ca3af" font-size="8">In Transit</text>
                                <rect x="4" y="4" width="392" height="192" fill="none" stroke="#e5e7eb" stroke-width="1" rx="8"/>
                            </svg>
                        </div>
                    @elseif (in_array($order->status, ['processing']))
                        <div class="text-center py-8">
                            <i class="fas fa-box-open text-3xl text-indigo-300 mb-3"></i>
                            <p class="text-sm text-gray-500">Your order is being prepared. Tracking will appear once shipped.</p>
                        </div>
                    @elseif ($order->status === 'cancelled')
                        <div class="text-center py-8">
                            <i class="fas fa-ban text-3xl text-red-300 mb-3"></i>
                            <p class="text-sm text-gray-500">This order was cancelled.</p>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-clock text-3xl text-gray-300 mb-3"></i>
                            <p class="text-sm text-gray-500">Tracking information will appear once your order is processed.</p>
                        </div>
                    @endif
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

                @if ($order->status !== 'cancelled')
                    <form action="{{ route('user.order.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                        @csrf
                        <button type="submit" class="w-full text-center px-6 py-2.5 border border-red-300 text-red-600 font-medium rounded-lg hover:bg-red-50 transition text-sm mt-3">
                            Cancel Order
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
