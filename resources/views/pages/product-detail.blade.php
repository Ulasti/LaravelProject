@extends('layouts.frontbase')

@section('title', $product->title . ' - ' . config('app.name'))

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-gray-500 mb-8">
                <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('shop') }}" class="hover:text-indigo-600">Shop</a>
                @if ($product->category)
                    <span class="mx-2">/</span>
                    <a href="{{ route('shop', ['category' => $product->category_id]) }}" class="hover:text-indigo-600">{{ $product->category->title }}</a>
                @endif
                <span class="mx-2">/</span>
                <span class="text-gray-900">{{ $product->title }}</span>
            </nav>

            <div class="lg:flex lg:space-x-12">
                @if ($product->image || $product->images->count())
                    @php $mainImg = $product->image ? asset('storage/' . $product->image) : ($product->images->first() ? asset('storage/' . $product->images->first()->image) : ''); @endphp

                    <div x-data="{
                        mainImage: '{{ $mainImg }}',
                        lightboxOpen: false,
                        setMain(src) { this.mainImage = src },
                        openLightbox() { this.lightboxOpen = true }
                    }" class="lg:w-1/2">
                        <div class="aspect-square bg-gray-100 overflow-hidden rounded-lg mb-4">
                            <img :src="mainImage" alt="{{ $product->title }}" class="w-full h-full object-cover cursor-zoom-in" @click="openLightbox()">
                        </div>

                        @if ($product->image || $product->images->count() > 1)
                            <div class="flex space-x-2 overflow-x-auto pb-1">
                                @if ($product->image)
                                    @php $imgUrl = asset('storage/' . $product->image); @endphp
                                    <img src="{{ $imgUrl }}" @click="setMain('{{ $imgUrl }}')" class="w-16 h-16 object-cover rounded-lg cursor-pointer flex-shrink-0 border-2" :class="{ 'border-indigo-600': mainImage === '{{ $imgUrl }}', 'border-gray-200': mainImage !== '{{ $imgUrl }}' }">
                                @endif
                                @foreach ($product->images as $img)
                                    @php $imgUrl = asset('storage/' . $img->image); @endphp
                                    <img src="{{ $imgUrl }}" @click="setMain('{{ $imgUrl }}')" class="w-16 h-16 object-cover rounded-lg cursor-pointer flex-shrink-0 border-2" :class="{ 'border-indigo-600': mainImage === '{{ $imgUrl }}', 'border-gray-200': mainImage !== '{{ $imgUrl }}' }">
                                @endforeach
                            </div>
                        @endif

                        <div x-show="lightboxOpen" x-cloak class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4" @keydown.escape.window="lightboxOpen = false">
                            <img :src="mainImage" alt="{{ $product->title }}" class="max-w-full max-h-full object-contain">
                            <button @click="lightboxOpen = false" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center text-white hover:text-gray-300 transition bg-black/30 rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="lg:w-1/2">
                        <div class="aspect-square bg-gray-100 flex items-center justify-center text-gray-400 mb-4">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                @endif

                <div class="lg:w-1/2 mt-8 lg:mt-0">
                    <p class="text-sm font-medium text-indigo-600 uppercase tracking-wider">{{ $product->category?->title ?? 'Uncategorized' }}</p>
                    <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $product->title }}</h1>
                    <p class="mt-4 text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>

                    @if ($product->description)
                        <div class="mt-6 text-gray-600 leading-relaxed prose prose-sm max-w-none">
                            {!! $product->description !!}
                        </div>
                    @endif

                    <div class="mt-8 flex items-center space-x-4">
                        <input type="number" value="1" min="1" max="{{ $product->quantity }}" class="w-20 px-4 py-2.5 border border-gray-300 rounded-lg text-sm text-center">
                        <button type="button" class="flex-1 px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition text-sm">Add to Cart</button>
                    </div>

                    <div class="mt-6 flex items-center space-x-6 text-sm text-gray-500">
                        <span>Stock: <span class="text-gray-900 font-medium">{{ $product->quantity }}</span></span>
                        @if ($product->status)
                            <span class="text-green-600 font-medium"><span class="text-green-500 mr-1">&#9679;</span>Active</span>
                        @endif
                    </div>

                    @if ($product->keywords)
                        <div class="mt-6">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Tags</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $product->keywords) as $tag)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-full">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
