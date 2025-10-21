@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto max-w-6xl py-8 px-4">
    <!-- Header with Order Status -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-8 mb-6 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Order #{{ $order->id }}</h1>
                <p class="text-blue-100 text-sm">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
            <div class="flex flex-col items-start md:items-end gap-2">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-400 text-yellow-900',
                        'invoice_sent' => 'bg-blue-400 text-blue-900',
                        'paid' => 'bg-green-400 text-green-900',
                        'shipped' => 'bg-purple-400 text-purple-900',
                        'delivered' => 'bg-teal-400 text-teal-900',
                        'cancelled' => 'bg-red-400 text-red-900',
                    ];
                    $statusColor = $statusColors[$order->status] ?? 'bg-gray-400 text-gray-900';
                @endphp
                <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-bold {{ $statusColor }} shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                </span>
                <p class="text-sm text-blue-100">Last updated {{ $order->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content Column -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Order Timeline Placeholder -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Order Timeline
                    </h2>
                </div>
                <div class="p-6">
                    <div class="relative">
                        <!-- Timeline placeholder -->
                        <div class="space-y-4">
                            @php
                                $timelineSteps = [
                                    ['label' => 'Order Placed', 'status' => 'completed', 'icon' => 'check'],
                                    ['label' => 'Invoice Sent', 'status' => in_array($order->status, ['invoice_sent', 'paid', 'shipped', 'delivered']) ? 'completed' : 'pending', 'icon' => 'document'],
                                    ['label' => 'Payment Received', 'status' => in_array($order->status, ['paid', 'shipped', 'delivered']) ? 'completed' : 'pending', 'icon' => 'currency'],
                                    ['label' => 'Shipped', 'status' => in_array($order->status, ['shipped', 'delivered']) ? 'completed' : 'pending', 'icon' => 'truck'],
                                    ['label' => 'Delivered', 'status' => $order->status === 'delivered' ? 'completed' : 'pending', 'icon' => 'check-circle'],
                                ];
                            @endphp
                            
                            @foreach ($timelineSteps as $index => $step)
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0">
                                        @if ($step['status'] === 'completed')
                                            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white shadow-md">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-semibold text-gray-800">{{ $step['label'] }}</p>
                                        <p class="text-sm text-gray-500">{{ $step['status'] === 'completed' ? 'Completed' : 'Pending' }}</p>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <div class="ml-5 h-8 w-0.5 {{ $step['status'] === 'completed' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Order Items
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <a href="{{ route('listing.details', $item->listing_id) }}" class="block group">
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-indigo-50 hover:shadow-md transition-all duration-200 border-2 border-transparent hover:border-indigo-300">
                                    <div class="flex items-center gap-4 flex-grow">
                                        <div class="w-20 h-20 bg-white rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden border-2 border-gray-200 group-hover:border-indigo-300 transition-colors shadow-sm">
                                            @if($item->listing->storeItem && $item->listing->storeItem->image_path)
                                                <img src="{{ $item->listing->storeItem->getImageUrl() }}" 
                                                     alt="{{ $item->listing->storeItem->title ?? 'Product' }}" 
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                            @else
                                                <svg class="w-10 h-10 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <h3 class="font-semibold text-gray-800 group-hover:text-indigo-700 text-lg transition-colors">
                                                {{ $item->listing->storeItem->title ?? 'N/A' }}
                                            </h3>
                                            <div class="flex items-center gap-2 mt-1">
                                                <p class="text-sm text-gray-500">Listing ID: #{{ $item->listing_id }}</p>
                                                @if($item->listing->condition)
                                                    <span class="text-gray-400">•</span>
                                                    <span class="text-sm text-gray-600 capitalize">{{ $item->listing->condition }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="text-right">
                                            <p class="text-xl font-bold text-indigo-600 group-hover:text-indigo-700 transition-colors">${{ number_format($item->price, 2) }}</p>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600 transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Chat/Messaging Placeholder -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Message {{ $isBuyer ? 'Seller' : 'Buyer' }}
                    </h2>
                </div>
                <div class="p-6">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 text-center border-2 border-dashed border-indigo-300">
                        <svg class="w-16 h-16 mx-auto mb-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Chat Feature Coming Soon</h3>
                        <p class="text-gray-600 mb-4">Direct messaging with {{ $isBuyer ? 'the seller' : 'the buyer' }} will be available here.</p>
                        <button disabled class="px-6 py-3 bg-gray-300 text-gray-500 rounded-lg font-semibold cursor-not-allowed">
                            Start Conversation (Coming Soon)
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Order Summary -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden sticky top-4">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Order Summary
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Subtotal:</span>
                            <span class="text-gray-800 font-semibold">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Shipping:</span>
                            <span class="text-gray-800 font-semibold">${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-lg font-bold text-gray-800">Total:</span>
                            <span class="text-2xl font-bold text-indigo-600">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200 space-y-3">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <div class="flex-grow">
                                <p class="text-sm font-medium text-gray-600">{{ $isBuyer ? 'Buyer' : 'Role Placeholder' }}:</p>
                                <p class="text-gray-800 font-semibold">{{ $order->user->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <div class="flex-grow">
                                <p class="text-sm font-medium text-gray-600">{{ $isSeller ? 'Seller' : 'Role Placeholder' }}:</p>
                                <p class="text-gray-800 font-semibold">{{ $order->seller->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div class="flex-grow">
                                <p class="text-sm font-medium text-gray-600">Shipping Address:</p>
                                <p class="text-gray-800">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            <div class="flex-grow">
                                <p class="text-sm font-medium text-gray-600">Payment Method:</p>
                                <p class="text-gray-800 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Actions
                    </h2>
                </div>
                <div class="p-6 space-y-3">
                    @if ($isBuyer)
                        <!-- Buyer Actions -->
                        @if (in_array($order->status, ['invoice_sent', 'pending']))
                            <button class="w-full px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Pay Now
                            </button>
                        @else
                            <div class="w-full px-6 py-4 bg-gray-200 text-gray-500 font-bold rounded-xl text-center">
                                <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Payment {{ $order->status === 'paid' ? 'Completed' : 'Not Required' }}
                            </div>
                        @endif
                    @endif

                    @if ($isSeller)
                        <!-- Seller Actions -->
                        <button class="w-full px-6 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Change Status
                        </button>
                        
                        @if (!in_array($order->status, ['cancelled', 'delivered']))
                            <button class="w-full px-6 py-4 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel Order
                            </button>
                        @endif
                    @endif

                    <!-- Common Actions -->
                    <button class="w-full px-6 py-4 bg-white border-2 border-gray-300 hover:border-indigo-400 text-gray-700 hover:text-indigo-600 font-semibold rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
