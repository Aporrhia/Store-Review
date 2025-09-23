@extends('layouts.app')

@section('title', 'Media - Tenama')

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-white min-h-screen">
    <nav class="text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Media</span>
    </nav>
    <h1 class="text-4xl font-extrabold tracking-tight text-[#141414] mb-8">Media</h1>
    <div class="prose prose-lg max-w-none text-gray-700 mb-8">
        <p>
            Follow us on social media to stay updated with the latest news, product launches, and community stories from Tenama. 
            We share behind-the-scenes content, tennis tips, event highlights, and run exclusive campaigns and giveaways. 
            Join our community and be part of the conversation!
        </p>
    </div>

    <ul class="flex gap-12 justify-center my-16">
        <li>
            <x-social-icon icon="instagram" size="large" hover="black" />
        </li>
        <li>
            <x-social-icon icon="youtube" size="large" hover="black" />
        </li>
        <li>
            <x-social-icon icon="tiktok" size="large" hover="black" />
        </li>
    </ul>

    <style>
        .media-social-icon:hover {
            color: #000 !important;
        }
    </style>
</div>
@endsection