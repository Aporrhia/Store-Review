@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<!-- Payment Card Missing Modal -->
<div id="paymentCardModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Payment Method Missing</h2>
        </div>
        <p class="text-gray-600 mb-6">You need to add a payment card before you can proceed with the purchase. Please add your card details to continue.</p>
        <div class="flex gap-3">
            <button onclick="closeModal()" class="flex-1 px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                Cancel
            </button>
            <a href="{{ route('profile.paymentCards', ['id' => Auth::id()]) }}" class="flex-1 px-4 py-3 bg-lime-500 hover:bg-lime-600 text-white font-semibold rounded-lg transition-colors text-center">
                Add Card
            </a>
        </div>
    </div>
</div>
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
                    $sellerTotal = $items->sum(fn($item) => ($item->listing->price ?? 0));
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
                                <div class="w-20 h-20 rounded bg-white flex items-center justify-center overflow-hidden">
                                    <img src="{{ $item->listing->storeItem->getImageUrl() }}" alt="{{ $item->listing->storeItem->title }}" class="w-full h-full object-contain">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-lg text-gray-900 truncate">{{ $item->listing->storeItem->title ?? '' }}</div>
                                    <div class="text-sm text-gray-500 truncate">Brand: {{ $item->listing->storeItem->brand->name ?? 'N/A' }}</div>
                                </div>
                                <div class="text-lg font-bold text-gray-900 whitespace-nowrap">
                                    ${{ number_format($item->listing->price ?? 0, 2) }}
                                </div>
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
                        <form method="POST" action="{{ route('cart.buy.seller', ['seller_id' => $seller->id ?? 0]) }}" onsubmit="return checkPaymentCard(event)">
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
            </div>
        </div>
    @endif
</div>

<script>
const hasPaymentCard = {{ Auth::user()->paymentCards()->count() > 0 ? 'true' : 'false' }};

function checkPaymentCard(event) {
    if (!hasPaymentCard) {
        event.preventDefault();
        document.getElementById('paymentCardModal').classList.remove('hidden');
        document.getElementById('paymentCardModal').classList.add('flex');
        return false;
    }
    return true;
}

function closeModal() {
    document.getElementById('paymentCardModal').classList.add('hidden');
    document.getElementById('paymentCardModal').classList.remove('flex');
}

// Close modal on ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

// Close modal when clicking outside
document.getElementById('paymentCardModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});
</script>
@endsection
