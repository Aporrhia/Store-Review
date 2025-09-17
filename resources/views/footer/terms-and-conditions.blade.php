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
                                By accessing and using Tenama ("we," "our," or "us"), you agree to comply with and be bound by these Terms and Conditions. Tenama operates as a marketplace platform that connects buyers and sellers of tennis gear. We do not own or control the items listed by independent sellers, except where explicitly stated.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">2. Marketplace Role</h2>
                            <p class="mb-4">
                                Tenama provides the technology and services that enable users to create listings, discover products, and complete transactions. While we facilitate payments and communication, the actual contract of sale is between the buyer and the seller. Tenama is not responsible for the quality, legality, or safety of items sold by users.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">3. Accounts</h2>
                            <p class="mb-4">
                                To buy or sell on Tenama, you must create an account and provide accurate information. You are responsible for maintaining the confidentiality of your login details and for all activities conducted under your account.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">4. Seller Responsibilities</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Ensure that items listed are accurately described and lawful to sell.</li>
                                <li>Ship sold items promptly and provide buyers with relevant tracking information when applicable.</li>
                                <li>Comply with Tenama’s prohibited items and community guidelines.</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">5. Buyer Responsibilities</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Review item descriptions carefully before purchasing.</li>
                                <li>Use Tenama’s payment system for all transactions—off-platform transactions are not protected.</li>
                                <li>Respect seller policies on shipping and returns, as outlined in each listing.</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">6. Payments and Fees</h2>
                            <p class="mb-4">
                                Buyers agree to pay the listed price plus any applicable taxes and fees. Sellers authorize Tenama to collect payments on their behalf and deduct marketplace service fees before releasing payouts. Payment processing may be handled by third-party providers.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">7. Disputes</h2>
                            <p class="mb-4">
                                In the event of a disagreement between a buyer and seller, Tenama may assist in resolving the dispute but does not guarantee a particular outcome. Buyers and sellers are encouraged to communicate directly first. Tenama reserves the right to issue refunds or withhold payouts in cases of fraud, misrepresentation, or policy violations.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">8. Prohibited Uses</h2>
                            <p class="mb-4">You may not use Tenama for the following:</p>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Selling counterfeit, stolen, or unsafe goods.</li>
                                <li>Engaging in fraudulent transactions or chargeback abuse.</li>
                                <li>Bypassing Tenama’s payment system.</li>
                                <li>Posting false, misleading, or harmful content.</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">9. Disclaimer</h2>
                            <p class="mb-4">
                                Tenama provides the marketplace “as is” without warranties of any kind. We do not guarantee that listings will sell, that buyers will complete a purchase, or that items will meet expectations. To the fullest extent permitted by law, Tenama disclaims liability for damages arising from use of the platform.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">10. Changes to Terms</h2>
                            <p class="mb-4">
                                We may update these Terms and Conditions from time to time. Continued use of Tenama after changes are posted constitutes acceptance of the revised terms.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">11. Contact Information</h2>
                            <p class="mb-4">
                                If you have any questions about these Terms and Conditions, please contact us at:
                            </p>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-semibold">Tenama Support</p>
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
