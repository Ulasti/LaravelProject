@extends('layouts.frontbase')

@section('title', 'About - ' . config('app.name'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">About Us</h1>
        <div class="prose prose-gray max-w-none">
            <p class="text-lg text-gray-600 leading-relaxed">
                Welcome to {{ config('app.name') }}, your premier destination for quality products 
                and exceptional shopping experiences. Founded with a passion for bringing the best 
                to our customers, we've grown into a trusted name in e-commerce.
            </p>
            <p class="text-lg text-gray-600 leading-relaxed mt-4">
                Our mission is simple: provide top-quality products at competitive prices, 
                backed by outstanding customer service. We believe that shopping should be 
                enjoyable, convenient, and rewarding.
            </p>
        </div>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Quality Products</h3>
                <p class="mt-2 text-sm text-gray-500">Carefully curated selection of premium items</p>
            </div>
            <div class="text-center p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Fast Delivery</h3>
                <p class="mt-2 text-sm text-gray-500">Quick and reliable shipping to your doorstep</p>
            </div>
            <div class="text-center p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">24/7 Support</h3>
                <p class="mt-2 text-sm text-gray-500">Dedicated team ready to help anytime</p>
            </div>
        </div>
    </div>
@endsection
