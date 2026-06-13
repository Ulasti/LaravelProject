@extends('layouts.admin.adminbase')

@section('title', 'Messages - ' . config('app.name'))
@section('page_title', 'Messages')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Messages</span>
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
        <p class="text-sm text-gray-500">Contact messages from visitors.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">ID</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Name</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Email</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Message</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Status</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Date</th>
                    <th class="text-right pb-3 font-semibold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $msg)
                    <tr class="border-b border-gray-100">
                        <td class="py-3 pr-4 text-gray-900 font-medium">{{ $msg->id }}</td>
                        <td class="py-3 pr-4 text-gray-900">{{ $msg->name }}</td>
                        <td class="py-3 pr-4 text-gray-600">{{ $msg->email }}</td>
                        <td class="py-3 pr-4 text-gray-600 max-w-xs truncate">{{ $msg->message }}</td>
                        <td class="py-3 pr-4">
                            @if ($msg->status === 'new')
                                <span class="text-blue-600 font-medium"><span class="text-blue-500 mr-1">&#9679;</span>New</span>
                            @else
                                <span class="text-gray-600 font-medium">{{ ucfirst($msg->status) }}</span>
                            @endif
                        </td>
                        <td class="py-3 pr-4 text-gray-500">{{ $msg->created_at->format('M j, Y') }}</td>
                        <td class="py-3 text-right space-x-4">
                            <a href="{{ route('admin.message.show', $msg->id) }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Show</a>
                            <form action="{{ route('admin.message.destroy', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
