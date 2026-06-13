@extends('layouts.frontbase')

@section('title', 'FAQ - ' . config('app.name'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900">Frequently Asked Questions</h1>
            <p class="mt-2 text-gray-500">Find answers to common questions about our products and services.</p>
        </div>

        <div class="space-y-3">
            @forelse ($faqs as $faq)
                <div x-data="{ open: false }" class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div @click="open = !open" class="cursor-pointer">
                        <div class="flex items-center justify-between w-full px-6 py-4 transition hover:bg-gray-50">
                            <span class="text-sm font-medium text-gray-900 pr-4">{{ $faq->question }}</span>
                            <svg class="w-4 h-4 text-gray-400 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                        <div x-show="open" x-cloak class="px-6 pb-4">
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $faq->answer }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-12">No FAQs available yet.</p>
            @endforelse
        </div>
    </div>
@endsection
