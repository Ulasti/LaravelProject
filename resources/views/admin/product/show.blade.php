@extends('layouts.admin.adminbase')

@section('title', $product->title . ' - ' . config('app.name'))
@section('page_title', $product->title)

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('admin.product.index') }}" class="text-gray-500 hover:text-gray-900">Products</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">{{ $product->title }}</span>
@endsection

@section('content')
    <div class="max-w-lg space-y-6">
        <div>
            @if ($product->status)
                <span class="text-green-600 font-medium"><span class="text-green-500 mr-1">&#9679;</span>Active</span>
            @else
                <span class="text-red-600 font-medium"><span class="text-red-400 mr-1">&#9679;</span>Inactive</span>
            @endif
        </div>

        @if ($product->image)
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Image</h3>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-48 h-48 object-cover rounded-lg border border-gray-200">
            </div>
        @endif

        @if ($product->images->count())
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Gallery</h3>
                <div class="flex flex-wrap gap-3">
                    @foreach ($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image) }}" class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                    @endforeach
                </div>
            </div>
        @endif

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Title</h3>
            <p class="text-gray-900">{{ $product->title }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Slug</h3>
            <p class="text-gray-900">{{ $product->slug }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Category</h3>
            <p class="text-gray-900">{{ $product->category?->title ?? '—' }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Keywords</h3>
            <p class="text-gray-900">{{ $product->keywords ?? '—' }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Description</h3>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $product->description ?? '—' }}</p>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Price</h3>
                <p class="text-gray-900">${{ number_format($product->price, 2) }}</p>
            </div>
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Quantity</h3>
                <p class="text-gray-900">{{ $product->quantity }}</p>
            </div>
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Min Qty</h3>
                <p class="text-gray-900">{{ $product->min_quantity }}</p>
            </div>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tax Included</h3>
            <p class="text-gray-900">{{ $product->tax_included }}%</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</h3>
            <p class="text-gray-900">{{ $product->created_at->format('F j, Y g:i A') }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</h3>
            <p class="text-gray-900">{{ $product->updated_at->format('F j, Y g:i A') }}</p>
        </div>

        <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.product.edit', $product->id) }}" class="px-4 py-2 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-700 transition">Edit</a>
            <a href="{{ route('admin.product.index') }}" class="text-sm text-gray-500 hover:text-gray-900 font-medium">Back to List</a>
        </div>
    </div>
@endsection
