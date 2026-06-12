<header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-200">
    <div class="flex items-center justify-between h-14 px-6">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="flex items-center space-x-4 ml-auto" x-data="{ profileOpen: false }">
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-gray-900 transition hidden sm:block">View Site</a>

            <div class="relative">
                <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                    <div class="w-7 h-7 bg-indigo-100 rounded-full flex items-center justify-center">
                        <span class="text-xs font-semibold text-indigo-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                    <svg class="w-3.5 h-3.5 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="profileOpen" @click.away="profileOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1" x-cloak>
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Dashboard</a>
                    <div class="border-t border-gray-100"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
