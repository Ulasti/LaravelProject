@extends('layouts.frontbase')

@section('title', 'Dashboard - ' . config('app.name'))

@section('content')
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}</h1>
        <p class="mt-2 text-gray-500">Manage your account and view your activity.</p>

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="border-t-2 border-indigo-500 pt-4">
                <p class="text-sm font-medium text-gray-400">Orders</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
            </div>
            <div class="border-t-2 border-emerald-500 pt-4">
                <p class="text-sm font-medium text-gray-400">Reviews</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
            </div>
            <div class="border-t-2 border-amber-500 pt-4">
                <p class="text-sm font-medium text-gray-400">Wishlist</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
            </div>
        </div>
    </div>
@endsection
