@extends('layouts.admin.adminbase')

@section('title', 'Order #' . $order->id . ' - ' . config('app.name'))
@section('page_title', 'Order #' . $order->id)

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('admin.order.index') }}" class="text-gray-500 hover:text-gray-900">Orders</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">#{{ $order->id }}</span>
@endsection

@section('content')
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
                            <th class="text-center px-6 py-3 font-medium text-gray-500">Qty</th>
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
                <h2 class="text-base font-semibold text-gray-900 mb-4">Customer</h2>
                <div class="text-sm space-y-1">
                    <p class="text-gray-900">{{ $order->user->name }}</p>
                    <p class="text-gray-500">{{ $order->user->email }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4">Shipping</h2>
                <div class="text-sm space-y-2">
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

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4">Status</h2>
                <form action="{{ route('admin.order.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-3">
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach (['pending', 'processing', 'shipped', 'completed', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
