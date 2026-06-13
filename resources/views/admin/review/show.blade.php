@extends('layouts.admin.adminbase')

@section('title', 'Review #' . $review->id . ' - ' . config('app.name'))
@section('page_title', 'Review #' . $review->id)

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('admin.review.index') }}" class="text-gray-500 hover:text-gray-900">Reviews</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">#{{ $review->id }}</span>
@endsection

@section('content')
    <div class="max-w-lg space-y-6">
        <div>
            @if ($review->status === 'approved')
                <span class="text-green-600 font-medium"><span class="text-green-500 mr-1">&#9679;</span>Approved</span>
            @elseif ($review->status === 'rejected')
                <span class="text-red-600 font-medium"><span class="text-red-400 mr-1">&#9679;</span>Rejected</span>
            @else
                <span class="text-amber-600 font-medium"><span class="text-amber-400 mr-1">&#9679;</span>Pending</span>
            @endif
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Product</h3>
            <p class="text-gray-900">{{ $review->product?->title ?? '—' }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">User</h3>
            <p class="text-gray-900">{{ $review->user?->name ?? '—' }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Rating</h3>
            <div class="flex items-center space-x-0.5 mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rating)
                        <i class="fas fa-star text-amber-400"></i>
                    @else
                        <i class="far fa-star text-gray-300"></i>
                    @endif
                @endfor
            </div>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Review</h3>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $review->review }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Submitted</h3>
            <p class="text-gray-900">{{ $review->created_at->format('F j, Y g:i A') }}</p>
        </div>

        <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
            @if ($review->status !== 'approved')
                <form action="{{ route('admin.review.update', $review->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">Approve</button>
                </form>
            @endif
            @if ($review->status !== 'rejected')
                <form action="{{ route('admin.review.update', $review->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">Reject</button>
                </form>
            @endif
            <a href="{{ route('admin.review.index') }}" class="text-sm text-gray-500 hover:text-gray-900 font-medium">Back to List</a>
        </div>
    </div>
@endsection
