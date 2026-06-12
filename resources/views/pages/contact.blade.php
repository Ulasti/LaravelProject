@extends('layouts.frontbase')

@section('title', 'Contact - ' . config('app.name'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Contact Us</h1>
        <p class="text-lg text-gray-600 mb-8">Have a question or feedback? We'd love to hear from you.</p>

        @if (session('contact_sent'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-700">Thank you for your message! We'll get back to you soon.</p>
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea name="message" id="message" rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition font-medium">
                Send Message
            </button>
        </form>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Address</h3>
                <p class="mt-2 text-sm text-gray-500">123 Shop Street<br>City, State 12345</p>
            </div>
            <div class="text-center p-6 bg-white border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Email</h3>
                <p class="mt-2 text-sm text-gray-500">hello@example.com</p>
            </div>
            <div class="text-center p-6 bg-white border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Phone</h3>
                <p class="mt-2 text-sm text-gray-500">+1 (555) 123-4567</p>
            </div>
        </div>
    </div>
@endsection
