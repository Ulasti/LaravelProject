@extends('layouts.frontbase')

@section('title', 'Shop - ' . config('app.name'))

@section('content')
    <div>
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
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Shop</h1>
            <div class="flex items-center space-x-4">
                <select onchange="if(this.value) window.location.href='{{ route('shop') }}?category='+this.value; else window.location.href='{{ route('shop') }}';" class="appearance-none px-5 py-2.5 pr-14 border border-gray-300 rounded-lg text-sm bg-white text-gray-600 focus:ring-indigo-500 focus:border-indigo-500 bg-[length:16px] bg-[right_14px_center] bg-no-repeat" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2716%27 height=%2716%27 fill=%27none%27 stroke=%27%239ca3af%27 stroke-width=%272%27 viewBox=%270 0 24 24%27%3E%3Cpath d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E')">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                        @foreach ($cat->children as $child)
                            <option value="{{ $child->id }}" {{ request('category') == $child->id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->title }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
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
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                    @csrf
                                    @php $isWishlisted = \App\Services\WishlistService::isWishlisted($product->id); @endphp
                                    <button type="submit" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:border-red-300 hover:bg-red-50 transition" title="{{ $isWishlisted ? 'Remove from wishlist' : 'Add to wishlist' }}">
                                        <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart {{ $isWishlisted ? 'text-red-500' : 'text-gray-400' }} text-sm"></i>
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
            @empty
                <p class="col-span-full text-center text-gray-500 py-12">No products found.</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>

        @php $recentProducts = \App\Services\RecentViewsService::products(6); @endphp
        @if ($recentProducts->count())
            <section class="mt-16">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Recently Viewed</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                    @foreach ($recentProducts as $product)
                        <div class="bg-white border border-gray-100 overflow-hidden rounded-lg hover:shadow-lg transition group">
                            <a href="{{ route('product.detail', $product->slug) }}" class="block aspect-[4/3] bg-gray-100 overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                @endif
                            </a>
                            <div class="p-3">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-semibold text-gray-900 truncate">{{ $product->title }}</p>
                                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                        @csrf
                                        @php $isWishlisted = \App\Services\WishlistService::isWishlisted($product->id); @endphp
                                        <button type="submit" class="text-xs {{ $isWishlisted ? 'text-red-500' : 'text-gray-400' }} hover:text-red-500 transition" title="{{ $isWishlisted ? 'Remove from wishlist' : 'Add to wishlist' }}">
                                            <i class="{{ $isWishlisted ? 'fas' : 'far' }} fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                                <p class="mt-1 text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
