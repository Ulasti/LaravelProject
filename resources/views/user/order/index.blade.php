@extends('layouts.userbase')

@section('title', 'My Orders - ' . config('app.name'))

@section('content')
    <div>
        <h1 class="text-2xl font-bold text-gray-900 mb-6">My Orders</h1>

        @if ($orders->count())
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-6 py-4 font-medium text-gray-500">Order #</th>
                            <th class="text-left px-6 py-4 font-medium text-gray-500">Date</th>
                            <th class="text-right px-6 py-4 font-medium text-gray-500">Items</th>
                            <th class="text-right px-6 py-4 font-medium text-gray-500">Total</th>
                            <th class="text-center px-6 py-4 font-medium text-gray-500">Status</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('M j, Y') }}</td>
                                <td class="px-6 py-4 text-right text-gray-500">{{ $order->items->sum('quantity') }}</td>
                                <td class="px-6 py-4 text-right font-medium text-gray-900">${{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @switch($order->status)
                                            @case('pending') bg-yellow-100 text-yellow-800 @break
                                            @case('processing') bg-blue-100 text-blue-800 @break
                                            @case('shipped') bg-purple-100 text-purple-800 @break
                                            @case('completed') bg-green-100 text-green-800 @break
                                            @case('cancelled') bg-red-100 text-red-800 @break
                                            @default bg-gray-100 text-gray-800
                                        @endswitch
                                    ">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('user.order.show', $order) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <i class="fas fa-shopping-bag text-5xl text-gray-300 mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-900 mb-2">No orders yet</h2>
                <p class="text-gray-500 mb-6">You haven't placed any orders yet.</p>
                <a href="{{ route('shop') }}" class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
@endsection
