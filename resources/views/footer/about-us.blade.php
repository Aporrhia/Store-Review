@extends('layouts.app')

@section('title', 'About Us - Tenama')

@section('content')
<div class="relative flex size-full min-h-screen flex-col overflow-x-hidden group/design-root bg-white">
    <div class="flex h-full grow flex-col">
        <main class="flex flex-1">
            <div class="flex-1 p-8">
                <div class="mx-auto max-w-4xl">
                    <div class="mb-8">
                        <nav class="text-sm text-gray-500">
                            <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
                            <span class="mx-2">/</span>
                            <span class="text-gray-900">About Us</span>
                        </nav>
                    </div>
                    
                    <h1 class="text-4xl font-extrabold tracking-tight text-[#141414] mb-8">About Us</h1>
                    
                    <div class="prose prose-lg max-w-none text-gray-700">
                        <p class="text-lg text-gray-600 mb-8">
                            Welcome to Tenama, the dedicated marketplace for tennis enthusiasts. Our platform connects players, clubs, and retailers, giving everyone the chance to buy and sell tennis gear in one trusted community space.
                        </p>
                        
                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Our Story</h2>
                            <p class="mb-4">
                                Tenama started as a university project built by a group of tennis lovers who noticed a gap in how players buy and sell equipment. Instead of limiting tennis gear to traditional shops, we wanted to create a space where players could easily trade rackets, apparel, and accessories — whether brand new or well-loved and ready for a second life.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">What We Offer</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>A trusted marketplace for new and pre-owned tennis gear</li>
                                <li>Opportunities for players, shops, and clubs to sell directly to the community</li>
                                <li>Smart search and filters to help buyers find the right gear for their game</li>
                                <li>A growing community of tennis enthusiasts supporting each other</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Our Values</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Building a community where tennis players support one another</li>
                                <li>Making quality gear more accessible by encouraging resale and reuse</li>
                                <li>Trust and transparency in every transaction</li>
                                <li>Promoting sustainability in the tennis world</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Meet the Team</h2>
                            <p class="mb-4">
                                We are a group of students with different skills in web development, marketing, and design — but united by our passion for tennis. Together, we’re building Tenama not just as a platform, but as a community marketplace for players everywhere.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Contact Us</h2>
                            <p class="mb-4">
                                Have questions, ideas, or want to get involved? We’d love to hear from you!
                            </p>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-semibold">Tenama Team</p>
                                <p>Email: info@tenama.com</p>
                                <p>Phone: 1-800-TENAMA-1</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
