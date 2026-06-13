@inject('navCategories', 'App\Models\Category')

<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ open: false }">
        <div class="flex items-center justify-between h-16">
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-900 tracking-tight">
                {{ config('app.name') }}
            </a>

            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Home</a>

                <div class="relative" x-data="{ shopOpen: false }" @mouseenter="shopOpen = true" @mouseleave="shopOpen = false">
                    <a href="{{ route('shop') }}" class="flex items-center space-x-1 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                        <span>Shop</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                    <div x-show="shopOpen" x-cloak class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                        <a href="{{ route('shop') }}" class="block px-4 py-2 text-sm font-medium text-indigo-600 hover:bg-gray-50">All Products</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        @foreach ($navCategories->where('status', 1)->with('children')->orderBy('title')->get() as $cat)
                            <a href="{{ route('shop', ['category' => $cat->id]) }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50">{{ $cat->title }}</a>
                            @foreach ($cat->children as $child)
                                <a href="{{ route('shop', ['category' => $child->id]) }}" class="block px-4 py-2 pl-8 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50">{{ $child->title }}</a>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">About</a>
                <a href="{{ route('contact') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Contact</a>
                <a href="{{ route('faq') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">FAQ</a>
            </div>

            <div class="hidden lg:flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Sign In</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Get Started</a>
                @endguest
                @auth
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="profileOpen" @click.away="profileOpen = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1" x-cloak>
                            <a href="{{ route('user.home') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50">Dashboard</a>
                            @if (Auth::user()->hasRole('admin'))
                                <a href="{{ route('admin.home') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50">Admin Panel</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <button @click="open = !open" class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div x-show="open" x-cloak class="lg:hidden pb-4 border-t border-gray-200 mt-2 pt-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">Home</a>

            <div x-data="{ mobileShopOpen: false }">
                <button @click="mobileShopOpen = !mobileShopOpen" class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
                    <span>Shop</span>
                    <svg class="w-4 h-4" :class="{ 'rotate-180': mobileShopOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="mobileShopOpen" x-cloak class="pl-4 space-y-1">
                    <a href="{{ route('shop') }}" class="block px-3 py-2 text-sm font-medium text-indigo-600 hover:bg-gray-50 rounded-lg transition">All Products</a>
                    @foreach ($navCategories->where('status', 1)->with('children')->orderBy('title')->get() as $cat)
                        <a href="{{ route('shop', ['category' => $cat->id]) }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">{{ $cat->title }}</a>
                        @foreach ($cat->children as $child)
                            <a href="{{ route('shop', ['category' => $child->id]) }}" class="block px-3 py-2 pl-6 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">{{ $child->title }}</a>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <a href="{{ route('about') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">About</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">Contact</a>
            <a href="{{ route('faq') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">FAQ</a>
            @guest
                <div class="border-t border-gray-200 pt-2 mt-2 space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">Sign In</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-lg transition">Get Started</a>
                </div>
            @endguest
            @auth
                <div class="border-t border-gray-200 pt-2 mt-2 space-y-1">
                    <a href="{{ route('user.home') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">Dashboard</a>
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.home') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">Admin Panel</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>
</header>
