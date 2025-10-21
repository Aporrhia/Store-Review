{{-- filepath: resources/views/order/check-out-page.blade.php --}}
@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto max-w-6xl py-8 px-4">
    <h1 class="text-3xl font-bold mb-8 text-center text-[#141414]">Checkout</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Shipping Information -->
        <div>
            <form class="bg-white rounded-xl shadow-md p-6 space-y-6">
                <h2 class="text-xl font-bold mb-4 text-[#84cc16]">Shipping Information</h2>
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="full_name" name="full_name"
                        value="{{ auth()->user()->name ?? '' }}"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                        placeholder="Full Name" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email"
                        value="{{ auth()->user()->email ?? '' }}"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                        placeholder="Email Address" required>
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                    <input type="text" id="address" name="address"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                        placeholder="Street Address" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" id="city" name="city"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                            placeholder="City" required>
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                        <input type="text" id="state" name="state"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                            placeholder="State/Province" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">ZIP/Postal Code</label>
                        <input type="text" id="zip" name="zip"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                            placeholder="ZIP/Postal Code" required>
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <input type="text" id="country" name="country"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                            placeholder="Country" required>
                    </div>
                </div>
            </form>
        </div>
        <!-- Billing Information -->
        <div>
            <form class="bg-white rounded-xl shadow-md p-6 space-y-6">
                <h2 class="text-xl font-bold mb-4 text-[#84cc16]">Billing Information</h2>
                <div>
                    <label for="billing_name" class="block text-sm font-medium text-gray-700 mb-1">Billing Name</label>
                    <input type="text" id="billing_name" name="billing_name"
                        value="{{ auth()->user()->name ?? '' }}"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                        placeholder="Billing Name" required>
                </div>
                <div>
                    <label for="billing_address" class="block text-sm font-medium text-gray-700 mb-1">Billing Address</label>
                    <input type="text" id="billing_address" name="billing_address"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                        placeholder="Billing Address" required>
                </div>
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                    <select id="payment_method" name="payment_method"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]" required>
                        <option value="" disabled selected>Select Payment Method</option>
                        <option value="visa">Visa</option>
                        <option value="mastercard">MasterCard</option>
                        <option value="applepay">Apple Pay</option>
                        <option value="googlepay">Google Pay</option>
                        <option value="samsungpay">Samsung Pay</option>
                    </select>
                </div>
                <!-- Card fields (shown for Visa/MasterCard) -->
                <div id="card-fields" class="space-y-4">
                    <div>
                        <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                        <input type="text" id="card_number" name="card_number"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                            placeholder="Card Number">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                            <input type="text" id="expiry_date" name="expiry_date"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                                placeholder="MM/YY">
                        </div>
                        <div>
                            <label for="secure_code" class="block text-sm font-medium text-gray-700 mb-1">Security Code</label>
                            <input type="text" id="secure_code" name="secure_code"
                                maxlength="3"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                                placeholder="CVV">
                        </div>
                    </div>
                </div>
                <!-- Wallet fields (shown for Apple/Google/Samsung Pay) -->
                <div id="wallet-fields" class="space-y-4 hidden">
                    <div>
                        <label for="wallet_account" class="block text-sm font-medium text-gray-700 mb-1">Account Email or Phone</label>
                        <input type="text" id="wallet_account" name="wallet_account"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-[#84cc16] focus:ring-[#84cc16]"
                            placeholder="Email or Phone for Wallet">
                    </div>
                </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const paymentSelect = document.getElementById('payment_method');
                    const cardFields = document.getElementById('card-fields');
                    const walletFields = document.getElementById('wallet-fields');
                    paymentSelect.addEventListener('change', function () {
                        if (this.value === 'visa' || this.value === 'mastercard') {
                            cardFields.classList.remove('hidden');
                            walletFields.classList.add('hidden');
                        } else if (this.value === 'applepay' || this.value === 'googlepay' || this.value === 'samsungpay') {
                            cardFields.classList.add('hidden');
                            walletFields.classList.remove('hidden');
                        } else {
                            cardFields.classList.add('hidden');
                            walletFields.classList.add('hidden');
                        }
                    });
                });
            </script>
        </div>
        <!-- Order Summary -->
        <div>
<div class="bg-white rounded-xl shadow-md p-6 space-y-6">
    <h2 class="text-xl font-bold mb-4 text-[#84cc16]">Order Summary</h2>
    @if(isset($order))
        <ul class="divide-y divide-gray-200 mb-4">
            @foreach ($order->items as $item)
                <li class="py-3 flex justify-between items-center">
                    <span class="text-gray-700">{{ $item->listing->storeItem->title ?? 'N/A' }}</span>
                    <span class="font-semibold text-gray-900">${{ number_format($item->price, 2) }}</span>
                </li>
            @endforeach
        </ul>
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <span class="text-lg font-bold text-gray-800">Total:</span>
            <span class="text-2xl font-bold text-[#84cc16]">${{ number_format($order->total_amount, 2) }}</span>
        </div>

        <div class="mt-2 text-gray-500 text-xs">
            <span class="inline-flex items-center gap-1">
                <svg class="w-4 h-4 text-[#84cc16]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2zm0 0V7m0 4v4m0 0h4m-4 0H8"/>
                </svg>
                Secure payment powered by Tenama
            </span>
        </div>
    @else
        <div class="text-gray-500">No order data available.</div>
    @endif
    <button class="w-full px-6 py-4 bg-gradient-to-r from-lime-500 to-green-600 hover:from-lime-600 hover:to-green-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2 mt-6">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        Proceed to Payment
    </button>
</div>
        </div>
    </div>
</div>
@endsection