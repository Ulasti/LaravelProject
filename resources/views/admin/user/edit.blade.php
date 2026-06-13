@extends('layouts.admin.adminbase')

@section('title', 'Edit User Roles - ' . config('app.name'))
@section('page_title', 'Edit User Roles')

@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="text-gray-500 hover:text-gray-900">Home</a>
    <span class="text-gray-300 mx-2">/</span>
    <a href="{{ route('admin.user.index') }}" class="text-gray-500 hover:text-gray-900">Users</a>
    <span class="text-gray-300 mx-2">/</span>
    <span class="text-gray-900">{{ $user->name }}</span>
@endsection

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">User</p>
                    <p class="text-base font-semibold text-gray-900">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Roles</label>
                    <div class="space-y-3">
                        @foreach ($roles as $role)
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                <div>
                                    <span class="text-sm font-medium text-gray-900">{{ $role->name }}</span>
                                    @if ($role->description)
                                        <p class="text-xs text-gray-500">{{ $role->description }}</p>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('roles') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2 flex items-center space-x-3">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Save Roles</button>
                    <a href="{{ route('admin.user.index') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
