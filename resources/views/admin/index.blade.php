@extends('layouts.admin.adminbase')

@section('title', 'Admin Dashboard - ' . config('app.name'))
@section('page_title', 'Dashboard')

@section('breadcrumbs')
    <span class="text-gray-500">Dashboard</span>
@endsection

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Products</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-indigo-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Categories</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-list text-emerald-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Orders</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-truck text-amber-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">0</p>
                </div>
                <div class="w-12 h-12 bg-rose-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-rose-600 text-lg"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
