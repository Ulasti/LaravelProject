<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'User Panel - ' . config('app.name'))</title>

    @yield('css')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 antialiased" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden" @click="sidebarOpen = false"></div>

    <aside class="fixed inset-y-0 left-0 z-50 w-56 bg-white border-r border-gray-200 flex flex-col transform transition-transform duration-200 ease-in-out lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        @include('user.partials.sidebar')
    </aside>

    <div class="min-h-screen flex flex-col lg:pl-56">
        @include('user.partials.header')

        <main class="flex-1 px-8 py-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">@yield('page_title', 'Dashboard')</h1>
                <nav class="mt-1 flex items-center space-x-2 text-sm text-gray-500">
                    @yield('breadcrumbs')
                </nav>
            </div>
            @yield('content')
        </main>

        @include('user.partials.footer')
    </div>

    @livewireScripts
    @yield('js')
</body>
</html>
