@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<div class="container mx-auto max-w-3xl p-4">
    <h1 class="text-2xl font-bold mb-6">My Cart</h1>
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    @if(empty($sellers) || count($sellers) === 0)
        <div class="text-gray-500">Your cart is empty.</div>
    @else
    @php $grandTotal = 0; @endphp
        <div class="flex flex-col gap-8">
            @foreach($sellers as $block)
                @php
                    $seller = $block['seller'];
                    $items = $block['items'];
                    $sellerTotal = $items->sum(fn($item) => ($item->listing->price ?? 0) * $item->quantity);
                    $grandTotal += $sellerTotal;
                @endphp
                <div class="bg-white rounded shadow p-4">
                    <div class="mb-2 flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Seller:</span>
                        @if($seller)
                            <a href="{{ route('profile', ['id' => $seller->id]) }}" class="text-lime-600 hover:text-lime-700 font-medium">{{ $seller->name }}</a>
                        @else
                            <span class="text-gray-500">Unknown</span>
                        @endif
                    </div>
                    <div class="flex flex-col gap-4">
                        @foreach($items as $item)
                            <div class="flex items-center gap-4 p-3 border-b last:border-b-0">
                                <div class="w-20 h-20 rounded bg-gray-100 flex items-center justify-center overflow-hidden">
                                    <img src="{{ $item->listing->storeItem->getImageUrl() }}" alt="{{ $item->listing->storeItem->title }}" class="w-full h-full object-contain">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-lg text-gray-900 truncate">{{ $item->listing->storeItem->title ?? '' }}</div>
                                    <div class="text-sm text-gray-500 truncate">Brand: {{ $item->listing->storeItem->brand->name ?? 'N/A' }}</div>
                                </div>
                                <div class="text-lg font-bold text-gray-900 whitespace-nowrap">
                                    ${{ number_format(($item->listing->price ?? 0) * $item->quantity, 2) }}
                                </div>
                                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="flex items-center gap-2">
                                    @csrf
                                    <div class="flex items-center border rounded-lg overflow-hidden bg-gray-50 shadow-sm">
                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="px-2 py-1 text-gray-500 hover:text-lime-600 focus:outline-none">-</button>
                                        <input name="quantity" type="number" min="1" max="99" value="{{ $item->quantity }}" class="w-14 text-center bg-transparent border-0 focus:ring-0 text-lg font-semibold text-gray-900" style="appearance: textfield;" />
                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="px-2 py-1 text-gray-500 hover:text-lime-600 focus:outline-none">+</button>
                                    </div>
                                    <button type="submit" title="Update Quantity" class="ml-1 inline-flex items-center justify-center p-2 rounded-full bg-lime-50 hover:bg-lime-100 transition-colors">
                                        <span class="material-symbols-outlined text-lime-600">refresh</span>
                                    </button>
                                </form>
                                <a href="{{ route('listing.details', $item->listing->id) }}" title="View Listing" class="inline-flex items-center justify-center p-2 rounded-full hover:bg-gray-100 transition-colors">
                                    <span class="material-symbols-outlined text-lime-600">visibility</span>
                                </a>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-1">
                                    @csrf
                                    <button type="submit" title="Remove from Cart" class="inline-flex items-center justify-center p-2 rounded-full hover:bg-red-50 transition-colors">
                                        <span class="material-symbols-outlined text-red-600">delete</span>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <div class="text-right font-bold">Subtotal: {{ number_format($sellerTotal, 2) }}</div>
                        <form method="POST" action="{{ route('cart.buy.seller', ['seller_id' => $seller->id ?? 0]) }}">
                            @csrf
                            <button type="submit" class="ml-4 bg-lime-500 hover:bg-lime-600 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2 shadow">
                                <span class="material-symbols-outlined">shopping_bag</span>
                                Buy from this Seller
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-between items-center mt-4">
                <div class="text-right font-bold text-lg">Grand Total: {{ number_format($grandTotal, 2) }}</div>
                <form method="POST" action="{{ route('cart.buy.all') }}">
                    @csrf
                    <button type="submit" class="ml-4 bg-lime-600 hover:bg-lime-700 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200 flex items-center gap-2 shadow-lg">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        Buy All
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
