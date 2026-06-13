<section class="relative" x-data="{ current: 0, total: {{ $sliderProducts?->count() ?? 1 }} }" x-init="if(total > 1) setInterval(() => { current = (current + 1) % total }, 5000)">
    @forelse ($sliderProducts as $i => $product)
        <div x-show="current === {{ $i }}" x-cloak x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="relative bg-gradient-to-br from-indigo-600 to-purple-700 overflow-hidden rounded-b-lg">
                @if ($product->image)
                    <div class="absolute inset-0">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full h-full object-cover opacity-20">
                    </div>
                @endif
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="max-w-xl">
                            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight">{{ $product->title }}</h1>
                            <p class="mt-4 text-lg sm:text-xl text-indigo-100 leading-relaxed">{{ Str::limit(strip_tags($product->description ?? 'Curated just for you. Shop the latest collections with confidence and enjoy seamless shopping.'), 120) }}</p>
                            <div class="mt-8 flex items-center space-x-4">
                                <a href="{{ route('product.detail', $product->slug) }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-indigo-50 transition shadow-sm">
                                    Shop Now — ${{ number_format($product->price, 2) }}
                                </a>
                                <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 text-white font-medium rounded-lg ring-1 ring-white/30 hover:ring-white/50 transition">
                                    Browse All
                                </a>
                            </div>
                        </div>
                        @if ($product->image)
                            <div class="hidden lg:block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-80 h-80 object-cover rounded-lg shadow-lg">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="relative bg-gradient-to-br from-indigo-600 to-purple-700 overflow-hidden rounded-b-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="max-w-xl">
                        <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight">Discover Quality Products</h1>
                        <p class="mt-4 text-lg sm:text-xl text-indigo-100 leading-relaxed">Curated just for you. Shop the latest collections with confidence and enjoy seamless shopping.</p>
                        <div class="mt-8 flex items-center space-x-4">
                            <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-indigo-50 transition shadow-sm">
                                Shop Now
                            </a>
                            <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 text-white font-medium rounded-lg ring-1 ring-white/30 hover:ring-white/50 transition">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <div class="w-80 h-80 rounded-full bg-white/10 backdrop-blur-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforelse

    @if (isset($sliderProducts) && $sliderProducts->count() > 1)
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-2 z-10">
            @foreach ($sliderProducts as $i => $product)
                <button @click="current = {{ $i }}" :class="{ 'bg-white': current === {{ $i }}, 'bg-white/40': current !== {{ $i }} }" class="w-2 h-2 rounded-full transition-all duration-300" aria-label="Go to slide {{ $i + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>
