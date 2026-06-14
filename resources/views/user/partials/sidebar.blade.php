<div class="flex flex-col h-full">
    <div class="flex items-center h-14 px-5 border-b border-gray-200">
        <a href="{{ route('user.home') }}" class="text-base font-bold text-gray-900 tracking-tight">
            {{ config('app.name') }}
        </a>
    </div>

    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">
        <p class="px-3 mb-2 text-xs font-medium text-gray-300 uppercase tracking-wider">Menu</p>

        <a href="{{ route('user.home') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('user.home') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-tachometer-alt w-4 text-center"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('user.order.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('user.order*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-shopping-bag w-4 text-center"></i>
            <span>My Orders</span>
        </a>

        <a href="{{ route('user.review.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('user.review*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-star w-4 text-center"></i>
            <span>My Reviews</span>
        </a>

        <a href="{{ route('wishlist.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('wishlist*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-heart w-4 text-center"></i>
            <span>Wishlist</span>
        </a>

        <a href="{{ route('user.profile') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('user.profile') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-user w-4 text-center"></i>
            <span>Profile</span>
        </a>

        <p class="mt-6 mb-2 px-3 text-xs font-medium text-gray-300 uppercase tracking-wider">Shop</p>

        <a href="{{ route('home') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition border-l-2 border-transparent hover:border-gray-300">
            <i class="fas fa-store w-4 text-center"></i>
            <span>Visit Shop</span>
        </a>

        <a href="{{ route('shop') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition border-l-2 border-transparent hover:border-gray-300">
            <i class="fas fa-shopping-bag w-4 text-center"></i>
            <span>Browse Products</span>
        </a>

        @if (Auth::user()->hasRole('admin'))
            <p class="mt-6 mb-2 px-3 text-xs font-medium text-gray-300 uppercase tracking-wider">Admin</p>
            <a href="{{ route('admin.home') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('admin.*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
                <i class="fas fa-shield-alt w-4 text-center"></i>
                <span>Admin Panel</span>
            </a>
        @endif
    </div>

    <div class="border-t border-gray-200 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center space-x-3 w-full px-3 py-2 text-sm font-medium text-gray-400 hover:text-gray-900 transition">
                <i class="fas fa-sign-out-alt w-4 text-center"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
