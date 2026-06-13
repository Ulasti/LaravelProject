@extends('layouts.admin.adminbase')

@section('title', $faq->question . ' - ' . config('app.name'))
@section('page_title', $faq->question)

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('admin.faq.index') }}" class="text-gray-500 hover:text-gray-900">FAQ</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">{{ $faq->question }}</span>
@endsection

@section('content')
    <div class="max-w-lg space-y-6">
        <div>
            @if ($faq->status)
                <span class="text-green-600 font-medium"><span class="text-green-500 mr-1">&#9679;</span>Active</span>
            @else
                <span class="text-red-600 font-medium"><span class="text-red-400 mr-1">&#9679;</span>Inactive</span>
            @endif
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Question</h3>
            <p class="text-gray-900">{{ $faq->question }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Answer</h3>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $faq->answer }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Order</h3>
            <p class="text-gray-900">{{ $faq->order }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</h3>
            <p class="text-gray-900">{{ $faq->created_at->format('F j, Y g:i A') }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</h3>
            <p class="text-gray-900">{{ $faq->updated_at->format('F j, Y g:i A') }}</p>
        </div>

        <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.faq.edit', $faq->id) }}" class="px-4 py-2 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-700 transition">Edit</a>
            <a href="{{ route('admin.faq.index') }}" class="text-sm text-gray-500 hover:text-gray-900 font-medium">Back to List</a>
        </div>
    </div>
@endsection
