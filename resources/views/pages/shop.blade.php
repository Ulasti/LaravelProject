@extends('layouts.frontbase')

@section('title', 'Shop - ' . config('app.name'))

@section('content')
    <div>
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
                <a href="{{ route('product.detail', $product->slug) }}" class="group bg-white border border-gray-100 overflow-hidden rounded-lg hover:shadow-lg transition cursor-pointer">
                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-xs font-medium text-indigo-600 uppercase tracking-wider">{{ $product->category?->title ?? 'Uncategorized' }}</p>
                        <h3 class="mt-1 font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $product->title }}</h3>
                        <p class="mt-1 text-sm text-gray-500">${{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-center text-gray-500 py-12">No products found.</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
@endsection
