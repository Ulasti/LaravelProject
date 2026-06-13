<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">{{ config('app.name') }}</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Your one-stop shop for everything. Quality products, exceptional service.
                </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Quick Links</h3>
                <ul class="mt-2 space-y-1">
                    <li><a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-900 transition">Home</a></li>
                    <li><a href="{{ route('shop') }}" class="text-sm text-gray-500 hover:text-gray-900 transition">Shop</a></li>
                    <li><a href="{{ route('about') }}" class="text-sm text-gray-500 hover:text-gray-900 transition">About</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm text-gray-500 hover:text-gray-900 transition">Contact</a></li>
                    <li><a href="{{ route('faq') }}" class="text-sm text-gray-500 hover:text-gray-900 transition">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Contact</h3>
                <ul class="mt-2 space-y-1 text-sm text-gray-500">
                    <li>123 Shop Street</li>
                    <li>City, State 12345</li>
                    <li>hello@example.com</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-sm text-gray-400 text-center">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>
</footer>