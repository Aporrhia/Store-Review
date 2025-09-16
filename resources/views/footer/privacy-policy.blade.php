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
                                At Tenama, we collect information to provide you with the best tennis equipment shopping experience. We collect information in the following ways:
                            </p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Personal Information</h3>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Name, email address, and contact information when you create an account</li>
                                <li>Billing and shipping addresses for order processing</li>
                                <li>Payment information (processed securely through our payment partners)</li>
                                <li>Communication preferences and marketing subscriptions</li>
                            </ul>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Usage Information</h3>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Pages visited, products viewed, and search queries</li>
                                <li>Device information, IP address, and browser type</li>
                                <li>Shopping cart contents and purchase history</li>
                                <li>Customer service interactions and feedback</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">2. How We Use Your Information</h2>
                            <p class="mb-4">We use the information we collect to:</p>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>Process and fulfill your orders for tennis equipment and accessories</li>
                                <li>Communicate with you about your orders, account, and customer service</li>
                                <li>Personalize your shopping experience and product recommendations</li>
                                <li>Send marketing communications about new products and promotions (with your consent)</li>
                                <li>Improve our website functionality and user experience</li>
                                <li>Prevent fraud and ensure the security of our platform</li>
                                <li>Comply with legal obligations and enforce our terms of service</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">3. Information Sharing</h2>
                            <p class="mb-4">We do not sell, trade, or rent your personal information to third parties. We may share information in the following circumstances:</p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Service Providers</h3>
                            <p class="mb-4">
                                We work with trusted third-party service providers who assist us in operating our website, processing payments, fulfilling orders, and providing customer service. These partners are bound by confidentiality agreements.
                            </p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Legal Requirements</h3>
                            <p class="mb-4">
                                We may disclose information when required by law, to protect our rights, or to comply with legal proceedings.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">4. Data Security</h2>
                            <p class="mb-4">
                                We implement industry-standard security measures to protect your personal information:
                            </p>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li>SSL encryption for all data transmission</li>
                                <li>Secure payment processing through certified payment gateways</li>
                                <li>Regular security audits and updates</li>
                                <li>Access controls and employee training on data protection</li>
                                <li>Regular backups and disaster recovery procedures</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">5. Cookies and Tracking</h2>
                            <p class="mb-4">
                                Our website uses cookies and similar technologies to enhance your browsing experience:
                            </p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Essential Cookies</h3>
                            <p class="mb-4">Required for basic website functionality, shopping cart, and secure areas.</p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Analytics Cookies</h3>
                            <p class="mb-4">Help us understand how visitors use our website to improve user experience.</p>
                            <h3 class="text-xl font-semibold text-[#141414] mb-3">Marketing Cookies</h3>
                            <p class="mb-4">Used to show relevant advertisements and track campaign effectiveness (with your consent).</p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">6. Your Rights and Choices</h2>
                            <p class="mb-4">You have the following rights regarding your personal information:</p>
                            <ul class="list-disc pl-6 mb-4 space-y-2">
                                <li><strong>Access:</strong> Request a copy of the personal information we hold about you</li>
                                <li><strong>Correction:</strong> Update or correct inaccurate personal information</li>
                                <li><strong>Deletion:</strong> Request deletion of your personal information (subject to legal requirements)</li>
                                <li><strong>Portability:</strong> Receive your data in a structured, machine-readable format</li>
                                <li><strong>Marketing Opt-out:</strong> Unsubscribe from marketing communications at any time</li>
                                <li><strong>Cookie Management:</strong> Control cookie preferences through your browser settings</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">7. Children's Privacy</h2>
                            <p class="mb-4">
                                Our website is not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If we become aware that we have collected such information, we will take steps to delete it promptly.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">8. International Data Transfers</h2>
                            <p class="mb-4">
                                Your information may be transferred to and processed in countries other than your country of residence. We ensure that such transfers comply with applicable data protection laws and provide adequate protection for your personal information.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">9. Data Retention</h2>
                            <p class="mb-4">
                                We retain your personal information for as long as necessary to provide our services, comply with legal obligations, resolve disputes, and enforce our agreements. When no longer needed, we securely delete or anonymize your information.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">10. Changes to This Policy</h2>
                            <p class="mb-4">
                                We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. We will notify you of significant changes by posting the updated policy on our website and updating the "Last updated" date.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-[#141414] mb-4">11. Contact Us</h2>
                            <p class="mb-4">
                                If you have any questions about this Privacy Policy or our data practices, please contact us:
                            </p>
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
