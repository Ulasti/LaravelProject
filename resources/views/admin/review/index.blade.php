@extends('layouts.admin.adminbase')

@section('title', 'Reviews - ' . config('app.name'))
@section('page_title', 'Reviews')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Reviews</span>
@endsection

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
            <p class="text-green-700 text-sm">{{ session('success') }}</p>
            <button @click="show = false" class="text-green-500 hover:text-green-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Manage product reviews.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">ID</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Product</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">User</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Rating</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Review</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Status</th>
                    <th class="text-right pb-3 font-semibold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $review)
                    <tr class="border-b border-gray-100">
                        <td class="py-3 pr-4 text-gray-900 font-medium">{{ $review->id }}</td>
                        <td class="py-3 pr-4 text-gray-900 max-w-xs truncate">{{ $review->product?->title ?? '—' }}</td>
                        <td class="py-3 pr-4 text-gray-600">{{ $review->user?->name ?? '—' }}</td>
                        <td class="py-3 pr-4">
                            <div class="flex items-center space-x-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fas fa-star text-amber-400 text-xs"></i>
                                    @else
                                        <i class="far fa-star text-gray-300 text-xs"></i>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td class="py-3 pr-4 text-gray-600 max-w-xs truncate">{{ $review->review }}</td>
                        <td class="py-3 pr-4">
                            @if ($review->status === 'approved')
                                <span class="text-green-600 font-medium"><span class="text-green-500 mr-1">&#9679;</span>Approved</span>
                            @elseif ($review->status === 'rejected')
                                <span class="text-red-600 font-medium"><span class="text-red-400 mr-1">&#9679;</span>Rejected</span>
                            @else
                                <span class="text-amber-600 font-medium"><span class="text-amber-400 mr-1">&#9679;</span>Pending</span>
                            @endif
                        </td>
                        <td class="py-3 text-right space-x-2">
                            <a href="{{ route('admin.review.show', $review->id) }}" class="px-2.5 py-1 text-xs font-medium rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition">Show</a>
                            @if ($review->status !== 'approved')
                                <form action="{{ route('admin.review.update', $review->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="px-2.5 py-1 text-xs font-medium rounded bg-green-50 text-green-700 hover:bg-green-100 transition">Approve</button>
                                </form>
                            @endif
                            @if ($review->status !== 'rejected')
                                <form action="{{ route('admin.review.update', $review->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="px-2.5 py-1 text-xs font-medium rounded bg-red-50 text-red-700 hover:bg-red-100 transition">Reject</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.review.destroy', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this review?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 text-xs font-medium rounded bg-red-50 text-red-700 hover:bg-red-100 transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
