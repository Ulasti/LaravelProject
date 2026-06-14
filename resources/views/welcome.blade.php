@extends('layouts.frontbase', ['noWrapperPadding' => true])

@section('title', 'Home - ' . config('app.name'))

@section('content')
    @include('partials.front-slider', ['sliderProducts' => $sliderProducts])

    <section class="py-16">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-900">Shop by Category</h2>
            <p class="mt-2 text-gray-500">Browse our curated collections</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($categories as $cat)
                <a href="{{ route('shop', ['category' => $cat->id]) }}" class="group p-8 bg-white border border-gray-100 rounded-lg text-center hover:shadow-lg transition cursor-pointer">
                    @if ($cat->image)
                        <div class="w-16 h-16 mx-auto mb-4 overflow-hidden rounded-xl">
                            <img src="{{ $cat->imageUrl() }}" alt="{{ $cat->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                    @else
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $cat->title }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $cat->total_products }} products</p>
                </a>
            @empty
                <p class="col-span-full text-center text-gray-500 py-12">No categories yet.</p>
            @endforelse
        </div>
    </section>

    <section class="py-16 border-t border-gray-100">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-900">Featured Products</h2>
            <p class="mt-2 text-gray-500">Handpicked just for you</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($featuredProducts as $product)
                <div class="bg-white border border-gray-100 overflow-hidden rounded-lg hover:shadow-lg transition">
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
                        @if ($product->reviews_count > 0)
                            <div class="mt-1 flex items-center space-x-1">
                                <div class="flex items-center space-x-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($product->reviews_avg_rating ?? 0))
                                            <i class="fas fa-star text-amber-400 text-xs"></i>
                                        @else
                                            <i class="far fa-star text-gray-300 text-xs"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-400">({{ $product->reviews_count }})</span>
                            </div>
                        @endif
                        <div class="mt-2 flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
                            <form action="{{ route('cart.store', $product) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded-lg hover:bg-indigo-700 transition">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500 py-12">No products yet.</p>
            @endforelse
        </div>
    </section>

    @if ($latestProducts->count())
        <section class="py-16 border-t border-gray-100">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">New Arrivals</h2>
                <p class="mt-2 text-gray-500">The latest products added to our store</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($latestProducts as $product)
                    <div class="bg-white border border-gray-100 overflow-hidden rounded-lg hover:shadow-lg transition">
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
                            @if ($product->reviews_count > 0)
                                <div class="mt-1 flex items-center space-x-1">
                                    <div class="flex items-center space-x-0.5">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($product->reviews_avg_rating ?? 0))
                                                <i class="fas fa-star text-amber-400 text-xs"></i>
                                            @else
                                                <i class="far fa-star text-gray-300 text-xs"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-400">({{ $product->reviews_count }})</span>
                                </div>
                            @endif
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
                                <form action="{{ route('cart.store', $product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded-lg hover:bg-indigo-700 transition">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="py-16">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-lg p-8 sm:p-12 text-center">
            <h2 class="text-2xl font-bold text-white">Stay in the Loop</h2>
            <p class="mt-2 text-indigo-100">Get the latest products and deals delivered to your inbox.</p>
            <div class="mt-6 max-w-md mx-auto flex items-center space-x-3">
                <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-white text-sm placeholder-gray-400">
                <button type="button" class="px-5 py-2.5 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-indigo-50 transition text-sm whitespace-nowrap">Subscribe</button>
            </div>
        </div>
    </section>
@endsection
