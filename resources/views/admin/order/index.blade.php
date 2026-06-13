@extends('layouts.admin.adminbase')

@section('title', 'Orders - ' . config('app.name'))
@section('page_title', 'Orders')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Orders</span>
@endsection

@section('content')
    @if ($orders->count())
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-6 py-4 font-medium text-gray-500">Order #</th>
                        <th class="text-left px-6 py-4 font-medium text-gray-500">Customer</th>
                        <th class="text-right px-6 py-4 font-medium text-gray-500">Total</th>
                        <th class="text-center px-6 py-4 font-medium text-gray-500">Status</th>
                        <th class="text-left px-6 py-4 font-medium text-gray-500">Date</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->user->name }}</td>
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
                            <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('M j, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.order.show', $order) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">View</a>
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
            <p class="text-gray-400 text-lg">No orders yet.</p>
        </div>
    @endif
@endsection
