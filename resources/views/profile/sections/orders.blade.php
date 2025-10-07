@extends('profile.layout')

@section('profile-content')
<section class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">My Orders</h2>
    
    @if($orders->isEmpty())
        <div class="text-center text-gray-500 py-12">
            <span class="material-symbols-outlined text-6xl">inventory_2</span>
            <p class="mt-4 text-lg font-medium">You have no past orders.</p>
            <p class="mt-2 text-sm">When you place an order, it will appear here.</p>
            <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center justify-center rounded-md bg-lime-500 px-6 py-2.5 text-sm font-bold text-gray-900 shadow-sm transition-transform hover:scale-105 hover:bg-lime-400 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2">
                Start Shopping
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Code</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seller</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-4 py-2 font-mono text-sm text-lime-700">{{ $order->order_code }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2 text-gray-900 font-semibold">{{ $order->storeItem->title ?? '-' }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $order->storeItem->brand->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-gray-700">
                                @if($order->seller)
                                    <a href="{{ route('profile', ['id' => $order->seller->id]) }}" class="text-lime-700 hover:underline font-medium">{{ $order->seller->name }}</a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-900">{{ $order->quantity ?? 1 }}</td>
                            <td class="px-4 py-2 text-gray-900 font-bold">${{ number_format($order->price ?? 0, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                <div class="flex justify-center">
                    {{ $orders->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    @endif
</section>
@endsection