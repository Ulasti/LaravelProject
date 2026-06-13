@extends('layouts.admin.adminbase')

@section('title', 'Users - ' . config('app.name'))
@section('page_title', 'Users')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">Users</span>
@endsection

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
            <p class="text-green-700 text-sm">{{ session('success') }}</p>
            <button @click="show = false" class="text-green-500 hover:text-green-700">&times;</button>
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Manage user accounts and roles.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">ID</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Name</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Email</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Roles</th>
                    <th class="text-left pb-3 pr-4 font-semibold text-gray-900">Joined</th>
                    <th class="text-right pb-3 font-semibold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b border-gray-100">
                        <td class="py-3 pr-4 text-gray-900 font-medium">{{ $user->id }}</td>
                        <td class="py-3 pr-4 text-gray-900">{{ $user->name }}</td>
                        <td class="py-3 pr-4 text-gray-600">{{ $user->email }}</td>
                        <td class="py-3 pr-4">
                            <div class="flex flex-wrap gap-1">
                                @forelse ($user->roles as $role)
                                    <span class="px-2 py-0.5 text-xs font-medium rounded {{ $role->slug === 'admin' ? 'bg-indigo-50 text-indigo-700' : 'bg-gray-50 text-gray-600' }}">{{ $role->name }}</span>
                                @empty
                                    <span class="text-gray-400 text-xs">No roles</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="py-3 pr-4 text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="py-3 text-right">
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="px-2.5 py-1 text-xs font-medium rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition">Manage Roles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endsection
