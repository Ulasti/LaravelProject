@extends('layouts.admin.adminbase')

@section('title', 'Settings - ' . config('app.name'))
@section('page_title', 'Settings')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Settings</span>
@endsection

@section('content')
    <div class="text-center py-16">
        <p class="text-gray-400 text-lg mb-2">Settings coming soon</p>
        <p class="text-gray-400 text-sm">This section will be implemented in a future phase.</p>
    </div>
@endsection
