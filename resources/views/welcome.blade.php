@extends('layouts.frontbase')

@section('title', 'Home - ' . config('app.name'))

@section('content')
    @include('partials.front-slider')

    <section class="py-16">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-900">Shop by Category</h2>
            <p class="mt-2 text-gray-500">Browse our curated collections</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-8 bg-white rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition cursor-pointer">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Electronics</h3>
                <p class="mt-1 text-sm text-gray-500">12 products</p>
            </div>
            <div class="p-8 bg-white rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition cursor-pointer">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Books</h3>
                <p class="mt-1 text-sm text-gray-500">8 products</p>
            </div>
            <div class="p-8 bg-white rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition cursor-pointer">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Clothing</h3>
                <p class="mt-1 text-sm text-gray-500">24 products</p>
            </div>
            <div class="p-8 bg-white rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition cursor-pointer">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Accessories</h3>
                <p class="mt-1 text-sm text-gray-500">16 products</p>
            </div>
        </div>
    </section>

    <section class="py-16 border-t border-gray-100">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-900">Featured Products</h2>
            <p class="mt-2 text-gray-500">Handpicked just for you</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition cursor-pointer">
                    <div class="aspect-[4/3] bg-gray-100"></div>
                    <div class="p-4">
                        <p class="text-xs font-medium text-indigo-600 uppercase tracking-wider">Category</p>
                        <h3 class="mt-1 font-semibold text-gray-900">Product Name</h3>
                        <p class="mt-1 text-sm text-gray-500">$49.99</p>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <section class="py-16">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl p-8 sm:p-12 text-center">
            <h2 class="text-2xl font-bold text-white">Stay in the Loop</h2>
            <p class="mt-2 text-indigo-100">Get the latest products and deals delivered to your inbox.</p>
            <div class="mt-6 max-w-md mx-auto flex items-center space-x-3">
                <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-white text-sm placeholder-gray-400">
                <button type="button" class="px-5 py-2.5 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-indigo-50 transition text-sm whitespace-nowrap">Subscribe</button>
            </div>
        </div>
    </section>
@endsection
