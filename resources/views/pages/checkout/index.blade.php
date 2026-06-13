@extends('layouts.frontbase')

@section('title', 'Checkout - ' . config('app.name'))

@section('content')
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Shipping Information</h2>
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" name="shipping_name" value="{{ old('shipping_name', $user->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_name') border-red-500 @enderror">
                                @error('shipping_name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea name="shipping_address" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address', $user->address) }}</textarea>
                                @error('shipping_address')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="text" name="shipping_phone" value="{{ old('shipping_phone', $user->phone) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_phone') border-red-500 @enderror">
                                @error('shipping_phone')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Order Notes (optional)</label>
                                <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('notes') border-red-500 @enderror" placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">
                                Place Order — ${{ number_format($total, 2) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        @foreach ($cart as $item)
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex-1 min-w-0 mr-4">
                                    <p class="text-gray-900 truncate">{{ $item['title'] }}</p>
                                    <p class="text-gray-400 text-xs">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <p class="text-gray-900 font-medium">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between">
                        <p class="text-base font-semibold text-gray-900">Total</p>
                        <p class="text-lg font-bold text-gray-900">${{ number_format($total, 2) }}</p>
                    </div>

                    @if ($user->card_nickname && $user->card_last_four)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Payment</p>
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-credit-card text-gray-400"></i>
                                <div class="text-sm">
                                    <p class="text-gray-900 font-medium">{{ $user->card_nickname }}</p>
                                    <p class="text-gray-400 text-xs">**** {{ $user->card_last_four }} @if ($user->card_expiry) | {{ $user->card_expiry }} @endif</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
