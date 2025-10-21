@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto max-w-6xl py-8 px-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Checkout</h1>
        <p class="text-gray-600">Complete your purchase</p>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf
        <input type="hidden" name="seller_id" value="{{ $seller->id }}">
        
        <!-- Main Content - Shipping Info -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Shipping Information -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-lime-50 to-green-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Shipping Information
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Name (Auto-filled) -->
                    <div>
                        <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                        <input type="text" id="full_name" name="full_name" readonly
                            value="{{ auth()->user()->name ?? '' }}"
                            class="w-full rounded-lg border-2 border-gray-200 bg-gray-50 px-4 py-3 focus:border-lime-400 focus:ring-2 focus:ring-lime-200 transition-colors cursor-not-allowed"
                            placeholder="Full Name">
                    </div>

                    <!-- Email (Auto-filled) -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" readonly
                            value="{{ auth()->user()->email ?? '' }}"
                            class="w-full rounded-lg border-2 border-gray-200 bg-gray-50 px-4 py-3 focus:border-lime-400 focus:ring-2 focus:ring-lime-200 transition-colors cursor-not-allowed"
                            placeholder="Email Address">
                    </div>

                    <!-- Shipping Address (Required) -->
                    <div>
                        <label for="shipping_address" class="block text-sm font-semibold text-gray-700 mb-2">
                            Shipping Address *
                        </label>
                        <textarea id="shipping_address" name="shipping_address" rows="3" required
                            class="w-full rounded-lg border-2 border-gray-300 px-4 py-3 focus:border-lime-400 focus:ring-2 focus:ring-lime-200 transition-colors resize-none"
                            placeholder="Enter your complete shipping address">{{ old('shipping_address', auth()->user()->address ?? '') }}</textarea>
                        @error('shipping_address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Country (Optional placeholder) -->
                        <div>
                            <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">Country</label>
                            <input type="text" id="country" name="country"
                                class="w-full rounded-lg border-2 border-gray-300 px-4 py-3 focus:border-lime-400 focus:ring-2 focus:ring-lime-200 transition-colors"
                                placeholder="Country (Optional)">
                        </div>

                        <!-- Phone Number (Optional placeholder) -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full rounded-lg border-2 border-gray-300 px-4 py-3 focus:border-lime-400 focus:ring-2 focus:ring-lime-200 transition-colors"
                                placeholder="Phone Number (Optional)">
                        </div>
                    </div>

                    <!-- ZIP Code (Optional placeholder) -->
                    <div>
                        <label for="zip_code" class="block text-sm font-semibold text-gray-700 mb-2">ZIP / Postal Code</label>
                        <input type="text" id="zip_code" name="zip_code"
                            class="w-full rounded-lg border-2 border-gray-300 px-4 py-3 focus:border-lime-400 focus:ring-2 focus:ring-lime-200 transition-colors"
                            placeholder="ZIP Code (Optional)">
                    </div>
                </div>
            </div>

            <!-- Order Items Preview -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-lime-50 to-green-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Order Items ({{ $items->count() }})
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border-2 border-gray-200">
                                <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden border-2 border-gray-200">
                                    @if($item->listing->storeItem && $item->listing->storeItem->image_path)
                                        <img src="{{ $item->listing->storeItem->getImageUrl() }}" 
                                             alt="{{ $item->listing->storeItem->title ?? 'Product' }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <h3 class="font-semibold text-gray-800">{{ $item->listing->storeItem->title ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-500">Listing #{{ $item->listing_id }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-lime-600">${{ number_format($item->listing->price ?? 0, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar - Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden sticky top-4">
                <div class="bg-gradient-to-r from-lime-50 to-green-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Order Summary
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Seller Info -->
                    <div class="pb-4 border-b border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Seller</p>
                        <p class="font-bold text-gray-800">{{ $seller->name }}</p>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-center pt-3 border-t-2 border-gray-300">
                            <span class="text-lg font-bold text-gray-800">Total:</span>
                            <span class="text-2xl font-bold text-lime-600">${{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full mt-6 px-6 py-4 bg-gradient-to-r from-lime-500 to-green-600 hover:from-lime-600 hover:to-green-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Place Order
                    </button>

                    <!-- Security Notice -->
                    <div class="mt-4 p-3 bg-lime-50 rounded-lg border border-lime-200">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-lime-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-lime-800">Secure Checkout</p>
                                <p class="text-xs text-lime-700 mt-1">Your information is protected with SSL encryption</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection