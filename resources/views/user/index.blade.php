@extends('layouts.userbase')

@section('title', 'User Dashboard - ' . config('app.name'))
@section('page_title', 'Dashboard')

@section('breadcrumbs')
    Dashboard
@endsection

@section('content')
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center justify-between">
            <p class="text-red-700 text-sm">{{ session('error') }}</p>
            <button @click="show = false" class="text-red-500 hover:text-red-700">&times;</button>
        </div>
    @endif

    <div class="max-w-3xl">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Welcome back, {{ Auth::user()->name }}</h2>
        <p class="text-sm text-gray-500 mb-8">Manage your account, reviews, and more.</p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="border-t-2 border-indigo-500 pt-4">
                <p class="text-sm font-medium text-gray-400">My Reviews</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ Auth::user()->reviews()->count() }}</p>
            </div>
            <div class="border-t-2 border-emerald-500 pt-4">
                <p class="text-sm font-medium text-gray-400">Orders</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
            </div>
            <div class="border-t-2 border-amber-500 pt-4">
                <p class="text-sm font-medium text-gray-400">Wishlist</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
            </div>
        </div>

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('user.review.index') }}" class="p-5 border border-gray-200 rounded-lg hover:border-indigo-300 hover:shadow-sm transition">
                <p class="font-semibold text-gray-900">My Reviews</p>
                <p class="text-sm text-gray-500 mt-1">View and manage your product reviews</p>
            </a>
            <a href="{{ route('user.profile') }}" class="p-5 border border-gray-200 rounded-lg hover:border-indigo-300 hover:shadow-sm transition">
                <p class="font-semibold text-gray-900">Profile Settings</p>
                <p class="text-sm text-gray-500 mt-1">Update your name, email, and password</p>
            </a>
        </div>
    </div>
@endsection
