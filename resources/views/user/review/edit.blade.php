@extends('layouts.userbase')

@section('title', 'Edit Review - ' . config('app.name'))
@section('page_title', 'Edit Review')

@section('breadcrumbs')
    <a href="{{ route('user.home') }}" class="text-gray-500 hover:text-gray-900">Dashboard</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('user.review.index') }}" class="text-gray-500 hover:text-gray-900">My Reviews</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Edit</span>
@endsection

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('user.review.update', $review->id) }}">
            @csrf
            @method('PUT')

            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Product</p>
                    <p class="text-base font-semibold text-gray-900">{{ $review->product?->title ?? '—' }}</p>
                </div>

                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <div class="flex items-center space-x-1" x-data="{ rating: {{ old('rating', $review->rating) }} }">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" @click="rating = {{ $i }}" class="text-2xl focus:outline-none transition-colors" :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-gray-300'">
                                <i class="fas" :class="rating >= {{ $i }} ? 'fa-star' : 'fa-star'"></i>
                            </button>
                        @endfor
                        <input type="hidden" name="rating" x-model="rating">
                    </div>
                    @error('rating') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="review" class="block text-sm font-medium text-gray-700 mb-1">Review</label>
                    <textarea name="review" id="review" rows="5" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('review') border-red-300 @enderror">{{ old('review', $review->review) }}</textarea>
                    @error('review') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2 flex items-center space-x-3">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Update Review</button>
                    <a href="{{ route('user.review.index') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
