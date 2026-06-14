@extends('layouts.frontbase')

@section('title', 'My Wishlist - ' . config('app.name'))

@section('content')
    <div>
        <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-gray-900">Home</a>
            <span class="text-gray-300">/</span>
            <span class="text-gray-900">My Wishlist</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Wishlist</h1>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
                <p class="text-green-700 text-sm">{{ session('success') }}</p>
                <button @click="show = false" class="text-green-500 hover:text-green-700"><i class="fas fa-times"></i></button>
            </div>
        @endif

        @if (session('info'))
            <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-between">
                <p class="text-blue-700 text-sm">{{ session('info') }}</p>
                <button @click="show = false" class="text-blue-500 hover:text-blue-700"><i class="fas fa-times"></i></button>
            </div>
        @endif

        @if ($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white border border-gray-100 overflow-hidden rounded-lg hover:shadow-lg transition group">
                        <a href="{{ route('product.detail', $product->slug) }}" class="block aspect-[4/3] bg-gray-100 overflow-hidden">
                            @if ($product->image)
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            @endif
                        </a>
                        <div class="p-4">
                            <p class="text-xs font-medium text-indigo-600 uppercase tracking-wider">{{ $product->category?->title ?? 'Uncategorized' }}</p>
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <h3 class="mt-1 font-semibold text-gray-900 hover:text-indigo-600 transition-colors">{{ $product->title }}</h3>
                            </a>
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:border-red-300 hover:bg-red-50 transition" title="Remove from wishlist">
                                            <i class="fas fa-heart text-red-500 text-sm"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.store', $product) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded-lg hover:bg-indigo-700 transition">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <i class="fas fa-heart text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500 mb-4">Your wishlist is empty.</p>
                <a href="{{ route('shop') }}" class="inline-flex px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">Browse Products</a>
            </div>
        @endif
    </div>
@endsection
