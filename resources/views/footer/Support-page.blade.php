@extends('layouts.app')

@section('title', 'Support - Tenama')

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
                            <span class="text-gray-900">Support</span>
                        </nav>
                    </div>
                    
                    <h1 class="text-4xl font-extrabold tracking-tight text-[#141414] mb-8">Support</h1>
                    
                    <div class="prose prose-lg max-w-none text-gray-700">
                        <p class="text-lg text-gray-600 mb-8">
                            Need help? The Tenama support team is here for you! Find answers to common questions or reach out to us directly for assistance with your tennis shopping experience.
                        </p>
                        
                        <!-- Support Form -->
                        <section class="mb-12">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Submit a Question</h2>
                            <form id="support-form" class="bg-gray-50 p-6 rounded-lg shadow flex flex-col gap-6" autocomplete="off">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input type="text" id="name" name="name" class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]" placeholder="Your Name" required>
                                </div>
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select id="category" name="category" class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]" required>
                                        <option value="">Select a category</option>
                                        <option value="order">Order Issue</option>
                                        <option value="shipping">Shipping</option>
                                        <option value="returns">Returns</option>
                                        <option value="product">Product Inquiry</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                    <textarea id="message" name="message" rows="5" class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]" placeholder="How can we help you?" required></textarea>
                                </div>
                                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-[#84cc16] px-6 py-2 text-white font-semibold hover:bg-[#6ca30f] transition-colors">
                                    Submit
                                </button>
                                <div id="support-success" class="hidden mt-2 text-green-600 font-semibold">
                                    Your question was sent! Thank you for contacting us.
                                </div>
                            </form>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const form = document.getElementById('support-form');
                                    const successMsg = document.getElementById('support-success');
                                    form.addEventListener('submit', function (e) {
                                        e.preventDefault();
                                        form.reset();
                                        successMsg.classList.remove('hidden');
                                        setTimeout(() => {
                                            successMsg.classList.add('hidden');
                                        }, 4000);
                                    });
                                });
                            </script>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Frequently Asked Questions</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>How do I track my order?</li>
                                <li>What is your return policy?</li>
                                <li>How can I contact customer service?</li>
                                <li>Do you offer international shipping?</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Shipping & Returns</h2>
                            <p class="mb-4">
                                We offer fast and reliable shipping for all tennis products. If you are not satisfied with your purchase, you can return most items within 30 days of delivery. Please contact our support team for more details.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Payment Methods</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Credit/Debit Cards</li>
                                <li>PayPal</li>
                                <li>Bank Transfer</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">Contact Support</h2>
                            <p class="mb-4">
                                If you need further assistance, please reach out to our support team. We aim to respond to all inquiries within 24 hours.
                            </p>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-semibold">Tenama Support</p>
                                <p>Email: support@tenama.com</p>
                                <p>Phone: 1-800-TENAMA-2</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection