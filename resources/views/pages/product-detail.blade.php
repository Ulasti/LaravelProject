@extends('layouts.frontbase')

@section('title', $product->title . ' - ' . config('app.name'))

@section('content')
    <div>
        <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-gray-900">Home</a>
            <span class="text-gray-300">/</span>
            <a href="{{ route('shop') }}" class="hover:text-gray-900">Shop</a>
            @if ($product->category)
                <span class="text-gray-300">/</span>
                <a href="{{ route('shop', ['category' => $product->category->id]) }}" class="hover:text-gray-900">{{ $product->category->title }}</a>
            @endif
            <span class="text-gray-300">/</span>
            <span class="text-gray-900">{{ $product->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                @if ($product->images->count())
                    <div x-data="{ activeImage: '{{ $product->image ? asset('storage/' . $product->image) : '' }}' }">
                        <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden mb-4 cursor-pointer" @click="window.open(activeImage, '_blank')">
                            <img :src="activeImage" alt="{{ $product->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex items-center space-x-3">
                            @if ($product->image)
                                <button @click="activeImage = '{{ asset('storage/' . $product->image) }}'" class="w-16 h-16 rounded-lg overflow-hidden border-2" :class="activeImage === '{{ asset('storage/' . $product->image) }}' ? 'border-indigo-600' : 'border-transparent'">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                </button>
                            @endif
                            @foreach ($product->images as $img)
                                <button @click="activeImage = '{{ asset('storage/' . $img->image) }}'" class="w-16 h-16 rounded-lg overflow-hidden border-2" :class="activeImage === '{{ asset('storage/' . $img->image) }}' ? 'border-indigo-600' : 'border-transparent'">
                                    <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @elseif ($product->image)
                    <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <div>
                @if ($product->category)
                    <p class="text-xs font-medium text-indigo-600 uppercase tracking-wider">{{ $product->category->title }}</p>
                @endif

                <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $product->title }}</h1>

                @if ($product->reviews_count > 0)
                    <div class="mt-3 flex items-center space-x-2">
                        <div class="flex items-center space-x-0.5">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($product->reviews_avg_rating ?? 0))
                                    <i class="fas fa-star text-amber-400 text-sm"></i>
                                @else
                                    <i class="far fa-star text-gray-300 text-sm"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500">({{ $product->reviews_count }} {{ Str::plural('review', $product->reviews_count) }})</span>
                    </div>
                @endif

                <p class="mt-4 text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>

                <div class="mt-6">
                    @if ($product->status)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>In Stock
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>Out of Stock
                        </span>
                    @endif
                    @if ($product->quantity)
                        <span class="ml-2 text-sm text-gray-500">{{ $product->quantity }} units available</span>
                    @endif
                </div>

                <div class="mt-8 flex items-center space-x-4">
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <button type="button" class="px-3 py-2 text-gray-500 hover:text-gray-900 transition">-</button>
                        <input type="number" value="1" min="1" class="w-12 text-center border-x border-gray-300 py-2 text-sm focus:outline-none">
                        <button type="button" class="px-3 py-2 text-gray-500 hover:text-gray-900 transition">+</button>
                    </div>
                    <button type="button" class="flex-1 px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">Add to Cart</button>
                </div>

                @if ($product->keywords)
                    <div class="mt-6 flex items-center space-x-2">
                        <span class="text-xs text-gray-400">Tags:</span>
                        @foreach (explode(',', $product->keywords) as $tag)
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-xs">{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if ($product->description)
            <div class="mt-16">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Description</h2>
                <div class="prose prose-gray max-w-none">
                    {!! $product->description !!}
                </div>
            </div>
        @endif

        <div class="mt-16">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Customer Reviews</h2>

            @auth
                @if (session('review_sent'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
                        <p class="text-green-700 text-sm">Thank you! Your review has been submitted and is pending approval.</p>
                        <button @click="show = false" class="text-green-500 hover:text-green-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Write a Review</h3>
                    <form action="{{ route('review.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                <div class="flex items-center space-x-1" x-data="{ rating: 0, hoverRating: 0 }">
                                    <template x-for="star in 5" :key="star">
                                        <button type="button" title="Click to rate" @click="rating = star" @mouseenter="hoverRating = star" @mouseleave="hoverRating = 0" class="focus:outline-none">
                                            <i :class="star <= (hoverRating || rating) ? 'fas fa-star text-amber-400' : 'far fa-star text-gray-300'" class="text-xl"></i>
                                        </button>
                                    </template>
                                    <input type="hidden" name="rating" x-model="rating" value="0">
                                </div>
                                @error('rating')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Your Review</label>
                                <textarea name="review" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('review') border-red-500 @enderror" placeholder="Share your experience with this product...">{{ old('review') }}</textarea>
                                @error('review')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">Submit Review</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8 text-center">
                    <p class="text-sm text-gray-600">
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Log in</a> or
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">register</a> to leave a review.
                    </p>
                </div>
            @endauth

            @if ($product->reviews->count())
                <div class="space-y-4">
                    @foreach ($product->reviews as $review)
                        <div class="bg-white border border-gray-200 rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-semibold text-indigo-600">{{ substr($review->user?->name ?? 'A', 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $review->user?->name ?? 'Anonymous' }}</p>
                                        <div class="flex items-center space-x-0.5 mt-0.5">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fas fa-star text-amber-400 text-xs"></i>
                                                @else
                                                    <i class="far fa-star text-gray-300 text-xs"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-400">{{ $review->created_at->format('M j, Y') }}</span>
                            </div>
                            <p class="mt-3 text-sm text-gray-600">{{ $review->review }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No reviews yet. Be the first to review this product!</p>
            @endif
        </div>
    </div>
@endsection
