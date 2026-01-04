@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto max-w-6xl py-8 px-4">
    <!-- Header with Order Status -->
    <div class="bg-gradient-to-r from-lime-500 to-green-700 rounded-2xl shadow-lg p-8 mb-6 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Order #{{ $order->id }}</h1>
                <p class="text-green-100 text-sm">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
            <div class="flex flex-col items-start md:items-end gap-2">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-400 text-yellow-900',
                        'invoice_sent' => 'bg-lime-400 text-lime-900',
                        'paid' => 'bg-green-400 text-green-900',
                        'shipped' => 'bg-lime-500 text-lime-900',
                        'delivered' => 'bg-green-500 text-green-900',
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
                <p class="text-sm text-green-100">Last updated {{ $order->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content Column -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Order Timeline Compact Row -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-lime-50 to-green-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Order Timeline
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center justify-center gap-4 md:gap-4">
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
                            <div class="flex flex-col items-center justify-center flex-1 min-w-[80px] text-center sm:w-full sm:min-w-0">
                                @if ($step['status'] === 'completed')
                                    <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white shadow-md mb-1">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-500 mb-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                        </svg>
                                    </div>
                                @endif
                                <span class="text-xs font-semibold text-gray-800 text-center block">{{ $step['label'] }}</span>
                                <span class="text-[11px] text-gray-500 text-center block">{{ $step['status'] === 'completed' ? 'Completed' : 'Pending' }}</span>
                            </div>
                            @if (!$loop->last)
                                <div class="hidden md:block flex-1 h-1 bg-gradient-to-r {{ $step['status'] === 'completed' ? 'from-green-500 to-green-500' : 'from-gray-300 to-gray-300' }} mx-2 self-center"></div>
                                <div class="block md:hidden w-1 h-6 mx-auto bg-gray-200"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-lime-50 to-green-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Order Items
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl shadow-sm border-2 border-gray-200">
                                <div class="flex items-center gap-4 flex-grow">
                                    <div class="w-20 h-20 bg-white rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden border-2 border-gray-200 shadow-sm">
                                        @if($item->listing->storeItem && $item->listing->storeItem->image_path)
                                            <img src="{{ $item->listing->storeItem->getImageUrl() }}" 
                                                 alt="{{ $item->listing->storeItem->title ?? 'Product' }}" 
                                                 class="w-full h-full object-contain">
                                        @else
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-semibold text-gray-800 text-lg">
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
                                <div class="text-right">
                                    <p class="text-xl font-bold text-[#84cc16]">${{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Chat/Messaging System -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-lime-50 to-green-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Message {{ $isBuyer ? 'Seller' : 'Buyer' }}
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Messages Display -->
                    <div id="messages-container" class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                        @forelse($order->messages as $message)
                            <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-[70%]">
                                    <div class="flex items-center gap-2 mb-1 {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                        <span class="text-xs font-semibold text-gray-600">{{ $message->user->name }}</span>
                                        <span class="text-xs text-gray-500">
                                            {{ $message->created_at->format('M j, Y g:i A') }}
                                            @if($message->created_at->diffInDays(now()) < 30)
                                                ({{ $message->created_at->diffForHumans() }})
                                            @endif
                                        </span>
                                    </div>
                                    <div class="px-4 py-3 rounded-lg {{ $message->user_id == Auth::id() ? 'bg-lime-500 text-white' : 'bg-gray-100 text-gray-800' }}">
                                        <p class="text-sm break-words">{{ $message->message }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8" id="no-messages-placeholder">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                                <p class="text-gray-500 text-sm">No messages yet. Start the conversation!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Message Form -->
                    <form method="POST" action="{{ route('order.sendMessage', ['id' => $order->id]) }}" class="border-t pt-4" id="message-form">
                        @csrf
                        <div class="space-y-3">
                            <textarea 
                                name="message" 
                                id="message-textarea"
                                rows="3" 
                                required 
                                maxlength="1000"
                                placeholder="Type your message here..."
                                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-lime-500 focus:border-lime-500 resize-none"
                            ></textarea>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">Max 1000 characters</span>
                                <button 
                                    type="submit" 
                                    class="px-6 py-2 bg-gradient-to-r from-lime-500 to-green-600 hover:from-lime-600 hover:to-green-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="mt-3 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Order Summary -->
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
                            <span class="text-2xl font-bold text-[#84cc16]">${{ number_format($order->total_amount, 2) }}</span>
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
                                <p class="text-sm font-medium text-gray-600">{{ $isSeller ? 'Seller' : 'Seller' }}:</p>
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
                <div class="bg-gradient-to-r from-lime-50 to-green-100 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Actions
                    </h2>
                </div>
                <div class="p-6 space-y-3">
                    @if ($isBuyer)
                        <!-- Buyer Actions -->
                        @if (in_array($order->status, ['invoice_sent', 'pending']))
                            <form method="POST" action="{{ route('order.pay', ['id' => $order->id]) }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-lime-500 to-green-600 hover:from-lime-600 hover:to-green-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Pay Now
                                </button>
                            </form>
                        @else
                            <div class="w-full px-6 py-4 bg-gray-200 text-gray-500 font-bold rounded-xl text-center">
                                <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Payment {{ in_array($order->status, ['paid', 'shipped', 'delivered']) ? 'Completed' : 'Not Required' }}
                            </div>
                        @endif
                    @endif

                    @if ($isSeller)
                        <!-- Seller Actions -->
                        @if ($order->status === 'paid')
                            <form method="POST" action="{{ route('order.changeStatus', ['id' => $order->id]) }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-lime-500 to-green-600 hover:from-lime-600 hover:to-green-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                                    Mark as Shipped
                                </button>
                            </form>
                        @elseif ($order->status === 'shipped')
                            <form method="POST" action="{{ route('order.changeStatus', ['id' => $order->id]) }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-lime-500 to-green-600 hover:from-lime-600 hover:to-green-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Is it Delivered?
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full px-6 py-4 bg-gray-300 text-gray-500 font-bold rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Waiting for Payment
                            </button>
                        @endif
                        
                        @if (!in_array($order->status, ['cancelled', 'delivered']))
                            <button class="w-full px-6 py-4 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel Order
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh chat messages every 7 seconds
const orderId = {{ $order->id }};
let lastMessageCount = {{ $order->messages->count() }};

function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    const options = { month: 'short', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true };
    const formatted = date.toLocaleString('en-US', options);
    
    if (diffDays < 30) {
        const rtf = new Intl.RelativeTimeFormat('en', { numeric: 'auto' });
        const diffMinutes = Math.round((date - now) / (1000 * 60));
        const diffHours = Math.round(diffMinutes / 60);
        
        let relative;
        if (Math.abs(diffMinutes) < 60) {
            relative = rtf.format(diffMinutes, 'minute');
        } else if (Math.abs(diffHours) < 24) {
            relative = rtf.format(diffHours, 'hour');
        } else {
            relative = rtf.format(-diffDays, 'day');
        }
        
        return `${formatted} (${relative})`;
    }
    
    return formatted;
}

function updateMessages() {
    fetch(`/order/${orderId}/messages`)
        .then(response => response.json())
        .then(data => {
            const messages = data.messages;
            const currentUserId = data.currentUserId;
            
            if (messages.length !== lastMessageCount) {
                const container = document.getElementById('messages-container');
                const scrolledToBottom = container.scrollHeight - container.scrollTop <= container.clientHeight + 100;
                
                // Remove no-messages placeholder if exists
                const placeholder = document.getElementById('no-messages-placeholder');
                if (placeholder) {
                    placeholder.remove();
                }
                
                // Clear and rebuild messages
                container.innerHTML = '';
                
                messages.forEach(message => {
                    const isSent = message.user_id === currentUserId;
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `flex ${isSent ? 'justify-end' : 'justify-start'}`;
                    
                    messageDiv.innerHTML = `
                        <div class="max-w-[70%]">
                            <div class="flex items-center gap-2 mb-1 ${isSent ? 'justify-end' : 'justify-start'}">
                                <span class="text-xs font-semibold text-gray-600">${message.user.name}</span>
                                <span class="text-xs text-gray-500">${formatDate(message.created_at)}</span>
                            </div>
                            <div class="px-4 py-3 rounded-lg ${isSent ? 'bg-lime-500 text-white' : 'bg-gray-100 text-gray-800'}">
                                <p class="text-sm break-words">${message.message}</p>
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(messageDiv);
                });
                
                lastMessageCount = messages.length;
                
                // Auto-scroll to bottom if user was already at bottom
                if (scrolledToBottom) {
                    container.scrollTop = container.scrollHeight;
                }
            }
        })
        .catch(error => console.error('Error fetching messages:', error));
}

// Clear textarea after successful form submission
document.getElementById('message-form').addEventListener('submit', function() {
    setTimeout(() => {
        document.getElementById('message-textarea').value = '';
        updateMessages(); // Immediately fetch new messages
    }, 500);
});

// Update messages every 7 seconds
setInterval(updateMessages, 7000);

// Scroll to bottom on page load if there are messages
window.addEventListener('load', function() {
    const container = document.getElementById('messages-container');
    if (container && lastMessageCount > 0) {
        container.scrollTop = container.scrollHeight;
    }
});
</script>

@endsection
