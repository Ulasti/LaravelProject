@extends('layouts.frontbase')

@section('title', 'Reset Password - ' . config('app.name'))

@section('content')
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">{{ config('app.name') }}</h1>
            <p class="mt-1 text-sm text-gray-500">Choose a new password</p>
        </div>

        <div class="bg-white border border-gray-100 p-8">
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="block">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <x-button>
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
