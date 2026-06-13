@extends('layouts.admin.adminbase')

@section('title', 'Orders - ' . config('app.name'))
@section('page_title', 'Orders')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Orders</span>
@endsection

@section('content')
    <div class="text-center py-16">
        <p class="text-gray-400 text-lg mb-2">Orders coming soon</p>
        <p class="text-gray-400 text-sm">This section will be implemented in a future phase.</p>
    </div>
@endsection
