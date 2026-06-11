@extends('layouts.frontbase')

@section('title', 'Shop - ' . config('app.name'))

@section('content')
    <div>
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Shop</h1>
            <div class="flex items-center space-x-4">
                <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Categories</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <p class="col-span-full text-center text-gray-500 py-12">Products coming soon.</p>
        </div>
    </div>
@endsection
