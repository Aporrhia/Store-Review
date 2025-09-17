@extends('layouts.app')

@section('title', 'Privacy Policy - Tenama')

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
                            <span class="text-gray-900">Privacy Policy</span>
                        </nav>
                    </div>
                    
                    <h1 class="text-4xl font-extrabold tracking-tight text-[#141414] mb-8">Privacy Policy</h1>
                    
                    <div class="prose prose-lg max-w-none text-gray-700">
                        <p class="text-lg text-gray-600 mb-8">Last updated: September 2025</p>
                        
                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">1. Information We Collect</h2>
                            <p class="mb-4">
                                Tenama collects information to operate our marketplace and provide a safe and efficient platform for buyers and sellers. This includes:
                            </p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Personal Information</h3>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Name, email, and contact details when creating an account</li>
                                <li>Billing or payout information for transactions</li>
                                <li>Shipping addresses provided by buyers</li>
                                <li>Seller business information and verification documents</li>
                            </ul>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Usage Information</h3>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Listings you view, items you purchase, or items you sell</li>
                                <li>Device information, IP address, and browser type</li>
                                <li>Interactions with other users and marketplace messages</li>
                                <li>Support inquiries and dispute records</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">2. How We Use Your Information</h2>
                            <p class="mb-4">We use your data to:</p>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Facilitate buying and selling transactions on the platform</li>
                                <li>Verify seller accounts and manage payouts</li>
                                <li>Communicate about listings, orders, account activity, and support inquiries</li>
                                <li>Provide personalized marketplace experiences and recommendations</li>
                                <li>Prevent fraud, abuse, and maintain marketplace security</li>
                                <li>Comply with legal obligations and enforce our Terms of Service</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">3. Information Sharing</h2>
                            <p class="mb-4">We do not sell your personal information. We may share data in the following ways:</p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Service Providers</h3>
                            <p class="mb-4">
                                Trusted third parties help us with payment processing, identity verification, shipping, dispute resolution, and marketplace operations. They are bound to protect your information.
                            </p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Legal Requirements</h3>
                            <p class="mb-4">
                                Information may be disclosed to comply with laws, legal proceedings, or to protect rights, safety, or property of Tenama, our users, or others.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">4. Data Security</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>SSL encryption for secure data transmission</li>
                                <li>Payment processing through certified providers</li>
                                <li>Access controls, employee training, and regular audits</li>
                                <li>Regular backups and disaster recovery procedures</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">5. Cookies and Tracking</h2>
                            <p class="mb-4">
                                We use cookies to provide core functionality, improve your marketplace experience, and deliver relevant communications (with consent).
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">6. Your Rights and Choices</h2>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Access and update your account and personal information</li>
                                <li>Request deletion of your information, subject to legal or transactional obligations</li>
                                <li>Manage marketing preferences or unsubscribe</li>
                                <li>Control cookies through your browser settings</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">7. Children's Privacy</h2>
                            <p class="mb-4">
                                Our marketplace is not directed to children under 13, and we do not knowingly collect personal data from them.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">8. International Data Transfers</h2>
                            <p class="mb-4">
                                Your information may be processed outside your country of residence. We ensure compliance with applicable data protection laws.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">9. Data Retention</h2>
                            <p class="mb-4">
                                Personal information is retained only as long as necessary for transactions, account management, dispute resolution, or legal compliance. Data no longer needed is securely deleted or anonymized.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">10. Changes to This Policy</h2>
                            <p class="mb-4">
                                We may update this policy to reflect operational, legal, or technological changes. Significant updates will be posted on the site with a revised "Last updated" date.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">11. Contact Us</h2>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-semibold">Tenama Privacy Team</p>
                                <p>Email: privacy@tenama.com</p>
                                <p>Phone: 1-800-TENAMA-1</p>
                                <p>Address: 123 Tennis Court Lane, Sports City, SC 12345</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
