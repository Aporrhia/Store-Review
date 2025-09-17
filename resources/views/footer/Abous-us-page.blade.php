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
                            Welcome to Tenama, your one-stop shop for all things tennis! We are a group of university students passionate about tennis and dedicated to providing quality tennis equipment and apparel to players of all levels.
                        </p>
                        
                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Our Story</h2>
                            <p class="mb-4">
                                Tenama was founded as a group project at our university, combining our love for tennis with our desire to create a modern, user-friendly online store. Our mission is to make it easy for tennis enthusiasts to find the best rackets, shoes, apparel, and accessories in one convenient place.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">What We Offer</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>High-quality tennis rackets for beginners and professionals</li>
                                <li>Comfortable and stylish tennis shoes</li>
                                <li>Apparel designed for performance and comfort on the court</li>
                                <li>Accessories including bags, grips, balls, and more</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Our Values</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Passion for tennis and sportsmanship</li>
                                <li>Commitment to quality and customer satisfaction</li>
                                <li>Supporting the tennis community at all levels</li>
                                <li>Continuous learning and improvement</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Meet the Team</h2>
                            <p class="mb-4">
                                We are a diverse group of students from different backgrounds, united by our enthusiasm for tennis and e-commerce. Our team brings together skills in web development, marketing, and customer service to deliver the best possible experience for our users.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Contact Us</h2>
                            <p class="mb-4">
                                Have questions, suggestions, or just want to say hello? We’d love to hear from you!
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