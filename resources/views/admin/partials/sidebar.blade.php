<div class="flex flex-col h-full">
    <div class="flex items-center h-16 px-6 border-b border-gray-200">
        <a href="{{ route('admin.home') }}" class="text-lg font-bold text-gray-900 tracking-tight">
            {{ config('app.name') }}
        </a>
    </div>

    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Main</p>

        <a href="{{ route('admin.home') }}" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.home') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
            <i class="fas fa-tachometer-alt w-5 text-center {{ request()->routeIs('admin.home') ? 'text-indigo-600' : 'text-gray-400' }}"></i>
            <span>Dashboard</span>
        </a>

        <div x-data="{ open: {{ request()->routeIs('admin.category*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.category*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                <span class="flex items-center space-x-3">
                    <i class="fas fa-list w-5 text-center {{ request()->routeIs('admin.category*') ? 'text-indigo-600' : 'text-gray-400' }}"></i>
                    <span>Categories</span>
                </span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-cloak class="mt-1 space-y-1 pl-11">
                <a href="#" class="block px-3 py-1.5 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">All Categories</a>
                <a href="#" class="block px-3 py-1.5 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">Add Category</a>
            </div>
        </div>

        <div x-data="{ open: {{ request()->routeIs('admin.product*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.product*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                <span class="flex items-center space-x-3">
                    <i class="fas fa-box w-5 text-center {{ request()->routeIs('admin.product*') ? 'text-indigo-600' : 'text-gray-400' }}"></i>
                    <span>Products</span>
                </span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-cloak class="mt-1 space-y-1 pl-11">
                <a href="#" class="block px-3 py-1.5 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">All Products</a>
                <a href="#" class="block px-3 py-1.5 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">Add Product</a>
            </div>
        </div>

        <p class="mt-6 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</p>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
            <i class="fas fa-truck w-5 text-center text-gray-400"></i>
            <span>Orders</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
            <i class="fas fa-envelope w-5 text-center text-gray-400"></i>
            <span>Messages</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
            <i class="fas fa-question-circle w-5 text-center text-gray-400"></i>
            <span>FAQ</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
            <i class="fas fa-star w-5 text-center text-gray-400"></i>
            <span>Reviews</span>
        </a>

        <p class="mt-6 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">System</p>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
            <i class="fas fa-users w-5 text-center text-gray-400"></i>
            <span>Users</span>
        </a>

        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
            <i class="fas fa-cog w-5 text-center text-gray-400"></i>
            <span>Settings</span>
        </a>
    </div>

    <div class="border-t border-gray-200 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center space-x-3 w-full px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
                <i class="fas fa-sign-out-alt w-5 text-center text-gray-400"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
