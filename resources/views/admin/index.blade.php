@extends('layouts.admin.adminbase')

@section('title', 'Admin Dashboard - ' . config('app.name'))
@section('page_title', 'Dashboard')

@section('breadcrumbs')
    Dashboard
@endsection

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="border-t-2 border-indigo-500 pt-4">
            <p class="text-sm font-medium text-gray-400">Products</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
        </div>

        <div class="border-t-2 border-emerald-500 pt-4">
            <p class="text-sm font-medium text-gray-400">Categories</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
        </div>

        <div class="border-t-2 border-amber-500 pt-4">
            <p class="text-sm font-medium text-gray-400">Orders</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
        </div>

        <div class="border-t-2 border-rose-500 pt-4">
            <p class="text-sm font-medium text-gray-400">Users</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
        </div>
    </div>
@endsection
