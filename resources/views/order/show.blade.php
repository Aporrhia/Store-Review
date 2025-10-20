@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto max-w-3xl py-8">
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-gray-600"><span class="font-semibold">Buyer:</span> {{ $order->user->name }}</p>
                <p class="text-gray-600"><span class="font-semibold">Seller:</span> {{ $order->seller->name }}</p>
                <p class="text-gray-600"><span class="font-semibold">Shipping Address:</span> {{ $order->shipping_address }}</p>
                <p class="text-gray-600"><span class="font-semibold">Payment Method:</span> {{ $order->payment_method }}</p>
            </div>
            <div>
                <p class="text-gray-600"><span class="font-semibold">Status:</span> {{ ucwords(str_replace('_', ' ', $order->status)) }}</p>
                <p class="text-gray-600"><span class="font-semibold">Subtotal:</span> ${{ number_format($subtotal, 2) }}</p>
                <p class="text-gray-600"><span class="font-semibold">Shipping:</span> ${{ number_format($shipping, 2) }}</p>
                <p class="text-gray-600"><span class="font-semibold">Total:</span> ${{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-xl font-semibold mb-4">Order Items</h3>
        <table class="w-full text-left border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4">Item</th>
                    <th class="py-2 px-4">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td class="py-2 px-4">{{ $item->listing->storeItem->title ?? 'N/A' }}</td>
                        <td class="py-2 px-4">${{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
