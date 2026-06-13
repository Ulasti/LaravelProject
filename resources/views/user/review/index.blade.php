@extends('layouts.userbase')

@section('title', 'My Reviews - ' . config('app.name'))
@section('page_title', 'My Reviews')

@section('breadcrumbs')
    <a href="{{ route('user.home') }}" class="text-gray-500 hover:text-gray-900">Dashboard</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">My Reviews</span>
@endsection

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
            <p class="text-green-700 text-sm">{{ session('success') }}</p>
            <button @click="show = false" class="text-green-500 hover:text-green-700">&times;</button>
        </div>
    @endif

    @if ($reviews->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-400 text-lg mb-2">No reviews yet</p>
            <p class="text-gray-400 text-sm mb-4">You haven't reviewed any products yet.</p>
            <a href="{{ route('shop') }}" class="inline-block px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Browse Products</a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Product</th>
                        <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Rating</th>
                        <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Review</th>
                        <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Status</th>
                        <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Date</th>
                        <th class="text-right pb-3 font-semibold text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4">
                                <a href="{{ route('product.detail', $review->product?->slug) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                    {{ $review->product?->title ?? '—' }}
                                </a>
                            </td>
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
                            <td class="py-3 pr-4 text-gray-500">{{ $review->created_at->format('M d, Y') }}</td>
                            <td class="py-3 text-right space-x-2">
                                <a href="{{ route('user.review.edit', $review->id) }}" class="px-2.5 py-1 text-xs font-medium rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition">Edit</a>
                                <form action="{{ route('user.review.destroy', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this review?')">
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
    @endif
@endsection
