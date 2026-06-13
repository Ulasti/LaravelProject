<div class="flex flex-col h-full">
    <div class="flex items-center h-14 px-5 border-b border-gray-200">
        <a href="{{ route('admin.home') }}" class="text-base font-bold text-gray-900 tracking-tight">
            {{ config('app.name') }}
        </a>
    </div>

    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">
        <p class="px-3 mb-2 text-xs font-medium text-gray-300 uppercase tracking-wider">Main</p>

        <a href="{{ route('admin.home') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('admin.home') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-tachometer-alt w-4 text-center"></i>
            <span>Dashboard</span>
        </a>

        <div x-data="{ open: {{ request()->routeIs('admin.category*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('admin.category*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
                <span class="flex items-center space-x-3">
                    <i class="fas fa-list w-4 text-center"></i>
                    <span>Categories</span>
                </span>
                <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-cloak class="mt-0.5 space-y-0.5">
                <a href="{{ route('admin.category.index') }}" class="block pl-12 pr-3 py-1.5 text-sm text-gray-500 hover:text-gray-900 transition">All Categories</a>
                <a href="{{ route('admin.category.create') }}" class="block pl-12 pr-3 py-1.5 text-sm text-gray-500 hover:text-gray-900 transition">Add Category</a>
            </div>
        </div>

        <div x-data="{ open: {{ request()->routeIs('admin.product*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('admin.product*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
                <span class="flex items-center space-x-3">
                    <i class="fas fa-box w-4 text-center"></i>
                    <span>Products</span>
                </span>
                <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-cloak class="mt-0.5 space-y-0.5">
                <a href="{{ route('admin.product.index') }}" class="block pl-12 pr-3 py-1.5 text-sm text-gray-500 hover:text-gray-900 transition">All Products</a>
                <a href="{{ route('admin.product.create') }}" class="block pl-12 pr-3 py-1.5 text-sm text-gray-500 hover:text-gray-900 transition">Add Product</a>
            </div>
        </div>

        <p class="mt-6 mb-2 px-3 text-xs font-medium text-gray-300 uppercase tracking-wider">Management</p>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition border-l-2 border-transparent hover:border-gray-300">
            <i class="fas fa-truck w-4 text-center"></i>
            <span>Orders</span>
        </a>

        <a href="{{ route('admin.message.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('admin.message*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-envelope w-4 text-center"></i>
            <span>Messages</span>
        </a>

        <a href="{{ route('admin.faq.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('admin.faq*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-question-circle w-4 text-center"></i>
            <span>FAQ</span>
        </a>

        <a href="{{ route('admin.review.index') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium transition border-l-2 {{ request()->routeIs('admin.review*') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }}">
            <i class="fas fa-star w-4 text-center"></i>
            <span>Reviews</span>
        </a>

        <p class="mt-6 mb-2 px-3 text-xs font-medium text-gray-300 uppercase tracking-wider">System</p>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition border-l-2 border-transparent hover:border-gray-300">
            <i class="fas fa-users w-4 text-center"></i>
            <span>Users</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition border-l-2 border-transparent hover:border-gray-300">
            <i class="fas fa-cog w-4 text-center"></i>
            <span>Settings</span>
        </a>
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
