@extends('layouts.app')

@section('title', 'Terms and Conditions - Tenama')

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
                            <span class="text-gray-900">Terms and Conditions</span>
                        </nav>
                    </div>
                    
                    <h1 class="text-4xl font-extrabold tracking-tight text-[#141414] mb-8">Terms and Conditions</h1>
                    
                    <div class="prose prose-lg max-w-none text-gray-700">
                        <p class="text-lg text-gray-600 mb-8">Last updated: September 2025</p>
                        
                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">1. Agreement to Terms</h2>
                            <p class="mb-4">
                                By accessing and using Tenama ("we," "our," or "us"), you accept and agree to be bound by the terms and provision of this agreement. These Terms and Conditions govern your use of our tennis equipment and accessories store.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">2. Use License</h2>
                            <p class="mb-4">
                                Permission is granted to temporarily access and use our website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                            </p>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>modify or copy the materials</li>
                                <li>use the materials for any commercial purpose or for any public display</li>
                                <li>attempt to reverse engineer any software contained on our website</li>
                                <li>remove any copyright or other proprietary notations from the materials</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">3. Product Information</h2>
                            <p class="mb-4">
                                We strive to provide accurate product descriptions, pricing, and availability information. However, we do not warrant that product descriptions or other content is accurate, complete, reliable, or error-free. All tennis equipment specifications are subject to manufacturer changes.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">4. Pricing and Payment</h2>
                            <p class="mb-4">
                                All prices displayed on our website are in USD and are subject to change without notice. We reserve the right to modify prices at any time. Payment must be received before shipment of products.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">5. Shipping and Returns</h2>
                            <p class="mb-4">
                                We offer shipping to various locations. Shipping times and costs vary by location and shipping method selected. Returns are accepted within 30 days of purchase for unused items in original packaging.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">6. User Account</h2>
                            <p class="mb-4">
                                When creating an account on our website, you must provide accurate and complete information. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">7. Privacy Policy</h2>
                            <p class="mb-4">
                                Your privacy is important to us. Our Privacy Policy explains how we collect, use, and protect your information when you use our service. By using our service, you agree to the collection and use of information in accordance with our Privacy Policy.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">8. Prohibited Uses</h2>
                            <p class="mb-4">You may not use our website:</p>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>For any unlawful purpose or to solicit others to perform unlawful acts</li>
                                <li>To violate any international, federal, provincial, or state regulations, rules, laws, or local ordinances</li>
                                <li>To infringe upon or violate our intellectual property rights or the intellectual property rights of others</li>
                                <li>To submit false or misleading information</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">9. Disclaimer</h2>
                            <p class="mb-4">
                                The materials on Tenama's website are provided on an 'as is' basis. Tenama makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">10. Contact Information</h2>
                            <p class="mb-4">
                                If you have any questions about these Terms and Conditions, please contact us at:
                            </p>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-semibold">Tenama Customer Service</p>
                                <p>Email: support@tenama.com</p>
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
