@extends('layouts.admin.adminbase')

@section('title', 'Message #' . $message->id . ' - ' . config('app.name'))
@section('page_title', 'Message #' . $message->id)

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('admin.message.index') }}" class="text-gray-500 hover:text-gray-900">Messages</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">#{{ $message->id }}</span>
@endsection

@section('content')
    <div class="max-w-lg space-y-6">
        <div>
            @if ($message->status === 'new')
                <span class="text-blue-600 font-medium"><span class="text-blue-500 mr-1">&#9679;</span>New</span>
            @else
                <span class="text-gray-600 font-medium">{{ ucfirst($message->status) }}</span>
            @endif
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Name</h3>
            <p class="text-gray-900">{{ $message->name }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Email</h3>
            <p class="text-gray-900">{{ $message->email }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Message</h3>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $message->message }}</p>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Received</h3>
            <p class="text-gray-900">{{ $message->created_at->format('F j, Y g:i A') }}</p>
        </div>

        <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.message.index') }}" class="text-sm text-gray-500 hover:text-gray-900 font-medium">Back to List</a>
        </div>
    </div>
@endsection
