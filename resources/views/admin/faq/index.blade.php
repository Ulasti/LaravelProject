@extends('layouts.admin.adminbase')

@section('title', 'FAQ - ' . config('app.name'))
@section('page_title', 'FAQ')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">FAQ</span>
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
        <p class="text-sm text-gray-500">Manage frequently asked questions.</p>
        <a href="{{ route('admin.faq.create') }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
            <i class="fas fa-plus mr-1.5"></i>Add FAQ
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">ID</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Question</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Order</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Status</th>
                    <th class="text-right pb-3 font-semibold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $faq)
                    <tr class="border-b border-gray-100">
                        <td class="py-3 pr-4 text-gray-900 font-medium">{{ $faq->id }}</td>
                        <td class="py-3 pr-4 text-gray-900 max-w-md truncate">{{ $faq->question }}</td>
                        <td class="py-3 pr-4 text-gray-600">{{ $faq->order }}</td>
                        <td class="py-3 pr-4">
                            @if ($faq->status)
                                <span class="text-green-600 font-medium"><span class="text-green-500 mr-1">&#9679;</span>Active</span>
                            @else
                                <span class="text-red-600 font-medium"><span class="text-red-400 mr-1">&#9679;</span>Inactive</span>
                            @endif
                        </td>
                        <td class="py-3 text-right space-x-4">
                            <a href="{{ route('admin.faq.show', $faq->id) }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Show</a>
                            <a href="{{ route('admin.faq.edit', $faq->id) }}" class="text-amber-600 hover:text-amber-700 font-medium">Edit</a>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this FAQ?')">
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
