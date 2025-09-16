@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    @include('store-page.components.breadcrumbs')
    <div class="grid grid-cols-1 mt-4 md:grid-cols-2 gap-12 bg-white rounded-lg shadow border border-gray-200 p-8">
        <div class="flex flex-col gap-6">
            <div class="w-full aspect-[4/3] rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                <img src="{{ $item->storeItem->getImageUrl() }}" alt="{{ $item->storeItem->title }}" class="object-cover w-full h-full">
            </div>
            <div class="flex flex-col gap-2">
                <span class="text-base text-gray-500">Seller: {{ $item->user->name ?? '' }}</span>
                <span class="text-base text-gray-500">Brand: {{ $item->storeItem->brand->name ?? '-' }}</span>
                <span class="text-base text-gray-500">Category: {{ $item->storeItem->category->name ?? '-' }}</span>
                <span class="text-base text-gray-500">SKU: {{ $item->storeItem->sku ?? '-' }}</span>
                <span class="text-base text-gray-500">Created: {{ $item->created_at->format('M d, Y') }}</span>
                <div class="mt-2">
                    <h4 class="font-semibold text-gray-700 mb-1">Attributes:</h4>
                    @forelse($item->storeItem->attributes as $attr)
                        <div class="text-sm text-gray-600">
                            <strong>{{ $attr->attribute->name }}:</strong> {{ $attr->value }}
                        </div>
                    @empty
                        <div class="text-sm text-gray-400">No attributes specified.</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-center">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-4xl font-extrabold text-[#141414]">{{ $item->storeItem->title ?? 'Listing Details' }}</h2>
                @if(auth()->check())
                    <form method="POST" action="{{ route('listing.like', $item->id) }}">
                            @csrf
                            <button type="submit" class="flex items-center justify-center rounded-full p-2.5 text-gray-500 hover:bg-gray-100 hover:text-[#84cc16] transition-colors" aria-label="Like Listing">
                                    <span class="material-symbols-outlined text-3xl {{ $isLiked ? 'text-[#84cc16]' : '' }}">favorite</span>
                            </button>
                    </form>
                @else
                    <span class="text-sm text-gray-500">To like this listing, please <a href="{{ route('login') }}" class="text-[#84cc16] font-bold hover:underline">sign in</a>.</span>
                @endif
            </div>
            <h2 class="text-3xl font-bold text-[#141414] mb-4">${{ $item->price }}</h2>
            <h3 class="text-lg font-bold text-[#141414] mb-2">Description</h3>
            <p class="text-gray-700 mb-4">{{ $item->storeItem->description ?? 'No description available.' }}</p>
            <!-- Add more details or actions here if needed -->
        </div>
    </div>

    <!-- Other listings for the same item -->
    @if(isset($otherListings) && $otherListings->count())
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-[#141414] mb-6">Other Listings for {{ $item->storeItem->title }}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($otherListings as $listing)
                    <div class="group relative">
                        <div class="w-full aspect-[3/4] overflow-hidden rounded-md bg-gray-100">
                            <img src="{{ $listing->storeItem->getImageUrl() }}" alt="{{ $listing->storeItem->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-base font-semibold text-[#141414]">
                                    <a href="{{ route('listing.details', $listing->storeItem->id) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $listing->storeItem->title ?? '' }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $listing->storeItem->category->name ?? '' }}</p>
                                <p class="mt-1 text-sm text-gray-500">Brand: {{ $listing->storeItem->brand->name ?? '' }}</p>
                                <p class="text-sm text-gray-500 mb-1">Seller: {{ $listing->user->name ?? '' }}</p>
                            </div>
                            <p class="text-base font-medium text-gray-900">${{ $listing->price }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
