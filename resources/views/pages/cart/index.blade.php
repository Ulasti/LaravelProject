@extends('layouts.frontbase')

@section('title', 'Cart - ' . config('app.name'))

@section('content')
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

        @if (session('cart_updated'))
            <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
                <p class="text-green-700 text-sm">Cart updated successfully.</p>
                <button @click="show = false" class="text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if (count($cart))
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-6 py-4 font-medium text-gray-500">Product</th>
                            <th class="text-center px-6 py-4 font-medium text-gray-500">Quantity</th>
                            <th class="text-right px-6 py-4 font-medium text-gray-500">Price</th>
                            <th class="text-right px-6 py-4 font-medium text-gray-500">Total</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($cart as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        @if ($item['image'])
                                            <div class="w-16 h-16 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $item['title'] }}</p>
                                            <p class="text-gray-400 text-xs mt-0.5">${{ number_format($item['price'], 2) }} each</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" x-data="{ qty: {{ $item['quantity'] }} }">
                                        @csrf
                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                            <button type="button" @click="qty = Math.max(0, qty - 1); $el.closest('form').querySelector('[name=quantity]').value = qty; $el.closest('form').submit()" class="px-2.5 py-1.5 text-gray-500 hover:text-gray-900 transition text-sm">−</button>
                                            <span class="w-8 text-center text-sm font-medium text-gray-900" x-text="qty"></span>
                                            <button type="button" @click="qty++; $el.closest('form').querySelector('[name=quantity]').value = qty; $el.closest('form').submit()" class="px-2.5 py-1.5 text-gray-500 hover:text-gray-900 transition text-sm">+</button>
                                            <input type="hidden" name="quantity" :value="qty">
                                        </div>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right text-gray-900">${{ number_format($item['price'], 2) }}</td>
                                <td class="px-6 py-4 text-right font-medium text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('cart.destroy', $item['product_id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition">
                        <i class="fas fa-trash-alt mr-1"></i> Clear Cart
                    </button>
                </form>
                <div class="text-right">
                    <p class="text-lg text-gray-500">Total: <span class="text-2xl font-bold text-gray-900">${{ number_format($total, 2) }}</span></p>
                    <a href="{{ route('checkout.index') }}" class="mt-3 inline-block px-8 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <i class="fas fa-shopping-cart text-5xl text-gray-300 mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-6">Looks like you haven't added anything yet.</p>
                <a href="{{ route('shop') }}" class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
@endsection
