@extends('layouts.admin.adminbase')

@section('title', $category->title . ' - ' . config('app.name'))
@section('page_title', $category->title)

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('admin.category.index') }}" class="text-gray-500 hover:text-gray-900">Categories</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">{{ $category->title }}</span>
@endsection

@section('content')
    <div class="max-w-lg space-y-6">
        <div>
            @if ($category->status)
                <span class="text-green-600 font-medium"><span class="text-green-500 mr-1">&#9679;</span>Active</span>
            @else
                <span class="text-red-600 font-medium"><span class="text-red-400 mr-1">&#9679;</span>Inactive</span>
            @endif
        </div>

        @if ($category->image)
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Image</h3>
                <img src="{{ $category->imageUrl() }}" alt="{{ $category->title }}" class="w-48 h-48 object-cover border border-gray-200">
            </div>
        @endif

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Title</h3>
            <p class="text-gray-900">{{ $category->title }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Parent Category</h3>
            <p class="text-gray-900">{{ $category->parent?->title ?? '—' }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Keywords</h3>
            <p class="text-gray-900">{{ $category->keywords ?? '—' }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Description</h3>
            <p class="text-gray-900">{{ $category->description ?? '—' }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</h3>
            <p class="text-gray-900">{{ $category->created_at->format('F j, Y g:i A') }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</h3>
            <p class="text-gray-900">{{ $category->updated_at->format('F j, Y g:i A') }}</p>
        </div>

        <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.category.edit', $category->id) }}" class="px-4 py-2 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-700 transition">Edit</a>
            <a href="{{ route('admin.category.index') }}" class="text-sm text-gray-500 hover:text-gray-900 font-medium">Back to List</a>
        </div>
    </div>
@endsection
