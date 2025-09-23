@extends('layouts.app')

@section('title', 'Media - Tenama')

@section('content')
<div class="max-w-6xl mx-auto p-8 bg-white min-h-screen">
    <nav class="text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Media</span>
    </nav>
    
    <div class="mb-12">
        <h1 class="text-4xl font-extrabold tracking-tight text-[#141414] mb-6">Connect with Tenama</h1>
        <p class="text-xl text-gray-600 leading-relaxed">
            Stay connected with the tennis community and never miss a beat from the world of tennis equipment and gear.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Social Media Links Section -->
        <div class="lg:col-span-1">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Follow Us</h2>
            <div class="space-y-6">
                <a href="https://www.instagram.com/tsi_university/" target="_blank" rel="noopener" class="group flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors block">
                    <div class="text-gray-600 group-hover:text-black transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5zm0 1.5h8.5A4.25 4.25 0 0 1 20.5 7.75v8.5A4.25 4.25 0 0 1 16.25 20.5h-8.5A4.25 4.25 0 0 1 3.5 16.25v-8.5A4.25 4.25 0 0 1 7.75 3.5zm4.25 3.25a5.25 5.25 0 1 0 0 10.5 5.25 5.25 0 0 0 0-10.5zm0 1.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5zm5.25.75a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Instagram</h3>
                        <p class="text-sm text-gray-600">Daily tennis gear highlights and community stories</p>
                    </div>
                </a>
                
                <a href="https://www.youtube.com/TSIRiga" target="_blank" rel="noopener" class="group flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors block">
                    <div class="text-gray-600 group-hover:text-black transition-colors">
                        <span class="sr-only">YouTube</span>
                        <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21.8 8.001a2.75 2.75 0 0 0-1.94-1.94C18.2 6 12 6 12 6s-6.2 0-7.86.06a2.75 2.75 0 0 0-1.94 1.94A28.6 28.6 0 0 0 2 12a28.6 28.6 0 0 0 .2 3.999 2.75 2.75 0 0 0 1.94 1.94C5.8 18 12 18 12 18s6.2 0 7.86-.06a2.75 2.75 0 0 0 1.94-1.94A28.6 28.6 0 0 0 22 12a28.6 28.6 0 0 0-.2-3.999zM10 15.5v-7l6 3.5-6 3.5z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">YouTube</h3>
                        <p class="text-sm text-gray-600">Product reviews and tennis technique tutorials</p>
                    </div>
                </a>
                
                <a href="https://www.tiktok.com/@tsi_university" target="_blank" rel="noopener" class="group flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors block">
                    <div class="text-gray-600 group-hover:text-black transition-colors">
                        <span class="sr-only">TikTok</span>
                        <svg aria-hidden="true" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.75 2v13.25a2.25 2.25 0 1 1-2.25-2.25c.124 0 .246.012.366.03V10.5a5.25 5.25 0 1 0 5.25 5.25V8.25c.66.36 1.42.57 2.25.57V6.75c-.83 0-1.59-.21-2.25-.57V2h-3.366z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">TikTok</h3>
                        <p class="text-sm text-gray-600">Quick tips and trending tennis content for players worldwide</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="lg:col-span-2">
            <div class="space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">What We Share</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-lime-50 to-lime-100 p-6 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">🎾 Product Spotlights</h3>
                            <p class="text-gray-700">In-depth looks at the latest rackets, strings, and accessories from top brands like Babolat, Wilson, and HEAD.</p>
                        </div>
                        
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">📚 Tennis Tips</h3>
                            <p class="text-gray-700">Expert advice on technique, equipment selection, and maintenance to help improve your game.</p>
                        </div>
                        
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">🏆 Community Stories</h3>
                            <p class="text-gray-700">Featuring customer reviews, success stories, and highlights from the tennis community.</p>
                        </div>
                        
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">🎁 Exclusive Offers</h3>
                            <p class="text-gray-700">First access to sales, new arrivals, and special promotions for our social media followers.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Join Our Community</h2>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <p class="text-gray-700 mb-4">
                            Be part of a passionate community of tennis enthusiasts. Share your own tennis journey, 
                            get advice from fellow players, and stay updated with the latest trends in tennis equipment.
                        </p>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-lime-500 rounded-full"></span>
                                Tag us in your posts for a chance to be featured
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-lime-500 rounded-full"></span>
                                Join live Q&A sessions with tennis experts
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-lime-500 rounded-full"></span>
                                Participate in equipment giveaways and contests
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-lime-500 rounded-full"></span>
                                Get early access to new product launches
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
