@extends('layouts.admin.adminbase')

@section('title', 'Add FAQ - ' . config('app.name'))
@section('page_title', 'Add FAQ')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('admin.faq.index') }}" class="text-gray-500 hover:text-gray-900">FAQ</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Add</span>
@endsection

@section('content')
    <div class="max-w-lg">
        <form action="{{ route('admin.faq.store') }}" method="POST">
            @csrf

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Question <span class="text-red-500">*</span></label>
                    <input type="text" name="question" value="{{ old('question') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('question') border-red-500 @enderror">
                    @error('question')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Answer <span class="text-red-500">*</span></label>
                    <textarea name="answer" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('answer') border-red-500 @enderror">{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                        <input type="number" name="order" value="{{ old('order', '0') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('order') border-red-500 @enderror">
                        @error('order')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center space-x-4">
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition text-sm">Save</button>
                <a href="{{ route('admin.faq.index') }}" class="text-sm text-gray-500 hover:text-gray-900 font-medium">Cancel</a>
            </div>
        </form>
    </div>
@endsection
