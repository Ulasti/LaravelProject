@extends('layouts.frontbase')

@section('title', 'Dashboard - ' . config('app.name'))

@section('content')
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}</h1>
        <p class="mt-2 text-gray-500">Manage your account and view your activity.</p>

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <p class="text-2xl font-bold text-gray-900">0</p>
                <p class="mt-1 text-sm text-gray-500">Orders</p>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <p class="text-2xl font-bold text-gray-900">0</p>
                <p class="mt-1 text-sm text-gray-500">Reviews</p>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <p class="text-2xl font-bold text-gray-900">0</p>
                <p class="mt-1 text-sm text-gray-500">Wishlist</p>
            </div>
        </div>
    </div>
@endsection
