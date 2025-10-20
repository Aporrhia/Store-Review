@extends('profile.layout')

@section('profile-content')
<section class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">My Orders</h2>
    
    @if($buyerOrdersPending->isEmpty() && $buyerOrdersCompleted->isEmpty() && $sellerOrdersPending->isEmpty() && $sellerOrdersCompleted->isEmpty())
        <div class="text-center text-gray-500 py-12">
            <span class="material-symbols-outlined text-6xl">inventory_2</span>
            <p class="mt-4 text-lg font-medium">You have no orders.</p>
            <p class="mt-2 text-sm">When you place or receive an order, it will appear here.</p>
            <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center justify-center rounded-md bg-lime-500 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition-transform hover:scale-105 hover:bg-lime-600 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2">
                Start Shopping
            </a>
        </div>
    @else
        <!-- Buyer Orders - Pending -->
        @if($buyerOrdersPending->isNotEmpty())
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Purchases - Pending</h3>
            <div class="space-y-4">
                @foreach($buyerOrdersPending as $order)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <a href="{{ route('order.show', $order->id) }}" class="text-lg font-semibold text-lime-600 hover:text-lime-700">Order #{{ $order->id }}</a>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                        <div class="border-t pt-3">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="text-gray-900 font-medium">{{ $item->listing->storeItem->title ?? 'N/A' }}</div>
                                    <div class="text-gray-600">${{ number_format($item->price, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center mt-3 pt-3 border-t">
                            <div class="text-sm text-gray-600">
                                Seller: <a href="{{ route('profile', $order->seller->id) }}" class="text-lime-600 hover:text-lime-700 font-medium">{{ $order->seller->name }}</a>
                            </div>
                            <div class="text-lg font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Buyer Orders - Completed -->
        @if($buyerOrdersCompleted->isNotEmpty())
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Purchases - Completed</h3>
            <div class="space-y-4">
                @foreach($buyerOrdersCompleted as $order)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow opacity-75">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <a href="{{ route('order.show', $order->id) }}" class="text-lg font-semibold text-lime-600 hover:text-lime-700">Order #{{ $order->id }}</a>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                        <div class="border-t pt-3">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="text-gray-900 font-medium">{{ $item->listing->storeItem->title ?? 'N/A' }}</div>
                                    <div class="text-gray-600">${{ number_format($item->price, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center mt-3 pt-3 border-t">
                            <div class="text-sm text-gray-600">
                                Seller: <a href="{{ route('profile', $order->seller->id) }}" class="text-lime-600 hover:text-lime-700 font-medium">{{ $order->seller->name }}</a>
                            </div>
                            <div class="text-lg font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Seller Orders - Pending -->
        @if($sellerOrdersPending->isNotEmpty())
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Sales - Pending</h3>
            <div class="space-y-4">
                @foreach($sellerOrdersPending as $order)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow bg-lime-50">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <a href="{{ route('order.show', $order->id) }}" class="text-lg font-semibold text-lime-600 hover:text-lime-700">Order #{{ $order->id }}</a>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                        <div class="border-t pt-3">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="text-gray-900 font-medium">{{ $item->listing->storeItem->title ?? 'N/A' }}</div>
                                    <div class="text-gray-600">${{ number_format($item->price, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center mt-3 pt-3 border-t">
                            <div class="text-sm text-gray-600">
                                Buyer: <a href="{{ route('profile', $order->user->id) }}" class="text-lime-600 hover:text-lime-700 font-medium">{{ $order->user->name }}</a>
                            </div>
                            <div class="text-lg font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Seller Orders - Completed -->
        @if($sellerOrdersCompleted->isNotEmpty())
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Sales - Completed</h3>
            <div class="space-y-4">
                @foreach($sellerOrdersCompleted as $order)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow bg-lime-50 opacity-75">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <a href="{{ route('order.show', $order->id) }}" class="text-lg font-semibold text-lime-600 hover:text-lime-700">Order #{{ $order->id }}</a>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                        <div class="border-t pt-3">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="text-gray-900 font-medium">{{ $item->listing->storeItem->title ?? 'N/A' }}</div>
                                    <div class="text-gray-600">${{ number_format($item->price, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center mt-3 pt-3 border-t">
                            <div class="text-sm text-gray-600">
                                Buyer: <a href="{{ route('profile', $order->user->id) }}" class="text-lime-600 hover:text-lime-700 font-medium">{{ $order->user->name }}</a>
                            </div>
                            <div class="text-lg font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    @endif
</section>
@endsection