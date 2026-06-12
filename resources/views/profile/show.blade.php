@extends('layouts.frontbase')

@section('title', 'Profile - ' . config('app.name'))

@section('content')
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Profile</h1>

    <div class="max-w-3xl">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
            <hr class="my-8 border-gray-200">
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            @livewire('profile.update-password-form')
            <hr class="my-8 border-gray-200">
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            @livewire('profile.two-factor-authentication-form')
            <hr class="my-8 border-gray-200">
        @endif

        @livewire('profile.logout-other-browser-sessions-form')

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <hr class="my-8 border-gray-200">
            @livewire('profile.delete-user-form')
        @endif
    </div>
@endsection
