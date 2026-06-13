@extends('layouts.userbase')

@section('title', 'Profile - ' . config('app.name'))
@section('page_title', 'Profile')

@section('breadcrumbs')
    <a href="{{ route('user.home') }}" class="text-gray-500 hover:text-gray-900">Dashboard</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Profile</span>
@endsection

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
            <p class="text-green-700 text-sm">{{ session('success') }}</p>
            <button @click="show = false" class="text-green-500 hover:text-green-700">&times;</button>
        </div>
    @endif

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
                <h3 class="text-base font-semibold text-gray-900">Profile Information</h3>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-300 @enderror">
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-300 @enderror">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Save Changes</button>
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('user.profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
                <h3 class="text-base font-semibold text-gray-900">Change Password</h3>

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('current_password') border-red-300 @enderror">
                    @error('current_password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" id="password" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-300 @enderror">
                    @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Update Password</button>
                </div>
            </div>
        </form>
    </div>
@endsection
