@extends('layouts.app')

@section('title', 'Frequently Asked Questions - Tenama')

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
                            <span class="text-gray-900">FAQ</span>
                        </nav>
                    </div>
                    
                    <h1 class="text-4xl font-extrabold tracking-tight text-[#141414] mb-8">Frequently Asked Questions</h1>
                    
                    <div class="space-y-4">
                        <!-- FAQ Item 1 -->
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-150 flex items-center justify-between" onclick="toggleFaq(1)">
                                <h3 class="text-lg font-semibold text-[#141414]">What types of tennis equipment do you sell?</h3>
                                <svg id="icon-1" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="answer-1" class="hidden px-6 pb-4">
                                <p class="text-gray-700">We offer a comprehensive range of tennis equipment including rackets, shoes, apparel, strings, grips, bags, and accessories. Our inventory features products from top brands like Wilson, Babolat, Head, and Yonex to meet the needs of players at all skill levels.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-150 flex items-center justify-between" onclick="toggleFaq(2)">
                                <h3 class="text-lg font-semibold text-[#141414]">How do I choose the right tennis racket?</h3>
                                <svg id="icon-2" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="answer-2" class="hidden px-6 pb-4">
                                <p class="text-gray-700">Choosing the right racket depends on your skill level, playing style, and physical attributes. Consider factors like weight, head size, string pattern, and grip size. Beginners typically benefit from lighter rackets with larger head sizes, while advanced players may prefer heavier, more control-oriented rackets. We recommend consulting our detailed product descriptions and customer reviews.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-150 flex items-center justify-between" onclick="toggleFaq(3)">
                                <h3 class="text-lg font-semibold text-[#141414]">What is your return policy?</h3>
                                <svg id="icon-3" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="answer-3" class="hidden px-6 pb-4">
                                <p class="text-gray-700">We offer a 30-day return policy for unused items in their original packaging. Items must be in new condition with all tags attached. Customized or personalized items cannot be returned unless defective. Return shipping costs are the responsibility of the customer unless the item was damaged or incorrectly sent.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-150 flex items-center justify-between" onclick="toggleFaq(4)">
                                <h3 class="text-lg font-semibold text-[#141414]">How long does shipping take?</h3>
                                <svg id="icon-4" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="answer-4" class="hidden px-6 pb-4">
                                <p class="text-gray-700">Standard shipping typically takes 3-7 business days within the Baltics. Express shipping (1-3 business days) and overnight shipping options are available at checkout. International shipping times vary by destination and can take 7-21 business days. All orders are processed within 1-2 business days.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-150 flex items-center justify-between" onclick="toggleFaq(6)">
                                <h3 class="text-lg font-semibold text-[#141414]">What payment methods do you accept?</h3>
                                <svg id="icon-6" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="answer-6" class="hidden px-6 pb-4">
                                <p class="text-gray-700">We accept all major credit cards (Visa, MasterCard, American Express, Discover), PayPal, Apple Pay, Google Pay, and Shop Pay. For large orders, we also offer financing options through Affirm. All transactions are processed securely using industry-standard encryption.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 6 -->
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-150 flex items-center justify-between" onclick="toggleFaq(7)">
                                <h3 class="text-lg font-semibold text-[#141414]">How do I track my order?</h3>
                                <svg id="icon-7" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="answer-7" class="hidden px-6 pb-4">
                                <p class="text-gray-700">Once your order ships, you'll receive a confirmation email with a tracking number. You can track your package using this number on the carrier's website (UPS, FedEx, or USPS). You can also log into your account to view order status and tracking information.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 7 -->
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-6 py-4 text-left bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors duration-150 flex items-center justify-between" onclick="toggleFaq(9)">
                                <h3 class="text-lg font-semibold text-[#141414]">How can I contact customer service?</h3>
                                <svg id="icon-9" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="answer-9" class="hidden px-6 pb-4">
                                <p class="text-gray-700">You can reach our customer service team by email at support@tenama.com, by phone at 1-800-TENAMA-1 (Monday-Friday, 9 AM-6 PM EST), or through our live chat feature available on our website. We strive to respond to all inquiries within 24 hours during business days.</p>
                            </div>
                        </div>

                    <div class="mt-12 bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-xl font-bold text-[#141414] mb-3">Still have questions?</h2>
                        <p class="text-gray-700 mb-4">Can't find the answer you're looking for? Our customer service team is here to help.</p>
                        <a href="{{ route('support') }}" class="inline-flex items-center justify-center rounded-md bg-[#141414] px-6 py-3 text-sm font-bold text-white hover:bg-gray-800 transition-colors duration-150">
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function toggleFaq(index) {
    const answer = document.getElementById(`answer-${index}`);
    const icon = document.getElementById(`icon-${index}`);
    
    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        answer.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>
@endsection
