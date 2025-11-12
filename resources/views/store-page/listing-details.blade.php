@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('store-page.components.breadcrumbs')
    
    <!-- Main Product Section -->
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
            <!-- Image Gallery Section -->
            <div class="p-8 bg-gray-50">
                <div class="sticky top-8">
                    <!-- Main Image -->
                    <div class="aspect-square rounded-xl overflow-hidden bg-white shadow-sm mb-4">
                        <img id="main-image" src="{{ $item->storeItem->getImageUrl() }}" alt="{{ $item->storeItem->title }}" 
                             class="w-full h-full object-contain">
                    </div>
                    
                    <!-- Thumbnail Gallery (for future expansion) -->
                    <div class="flex gap-3">
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-white shadow-sm border-2 border-lime-500 cursor-pointer flex items-center justify-center">
                            <img src="{{ $item->storeItem->getImageUrl() }}" alt="Thumbnail" class="w-full h-full object-contain">
                        </div>
                        <!-- Additional thumbnails can be added here -->
                    </div>
                </div>
            </div>

            <!-- Product Info Section -->
            <div class="p-8 flex flex-col">
                <!-- Header -->
                <div class="mb-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">{{ $item->storeItem->title ?? 'Product Details' }}</h1>
                            <div class="flex items-center gap-4 text-sm text-gray-600">
                                <span class="font-medium">Brand: <span class="text-gray-900">{{ $item->storeItem->brand->name ?? 'N/A' }}</span></span>
                                <span class="font-medium">SKU: <span class="text-gray-900">{{ $item->storeItem->sku ?? 'N/A' }}</span></span>
                            </div>
                        </div>
                        
                        <!-- Like Button -->
                        @if(auth()->check())
                            <form method="POST" action="{{ route('listing.like', $item->id) }}">
                                @csrf
                                <button type="submit" class="w-12 h-12 rounded-full border border-gray-200 hover:border-lime-500 hover:bg-lime-50 transition-all duration-200 group flex items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl {{ $isLiked ? 'text-lime-500' : 'text-gray-400 group-hover:text-lime-500' }}">favorite</span>
                                </button>
                            </form>
                        @else
                            <div class="text-sm text-gray-500 text-center">
                                <div class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center mb-1">
                                    <span class="material-symbols-outlined text-2xl text-gray-300">favorite</span>
                                </div>
                                <a href="{{ route('login') }}" class="text-lime-600 hover:text-lime-700 font-medium">Sign in to like</a>
                            </div>
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <div class="text-4xl font-bold text-gray-900">${{ $item->price }}</div>
                        <div class="text-sm text-gray-500 mt-1">Listed {{ $item->created_at->format('M d, Y') }}</div>
                    </div>
                </div>

                <!-- Seller Info -->
                <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Seller Information</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">{{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}</span>
                        </div>
                        <div>
                            @if($item->user)
                                <a href="{{ route('profile', ['id' => $item->user->id]) }}" class="text-lime-600 hover:text-lime-700 font-semibold">{{ $item->user->name }}</a>
                            @else
                                <span class="text-gray-500">Unknown Seller</span>
                            @endif
                            <div class="text-sm text-gray-500">Member since {{ $item->user->created_at->format('Y') ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Product Tabs -->
                <div class="mb-8">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8">
                            <button class="tab-button active py-2 px-1 border-b-2 font-medium text-sm" data-tab="description">
                                Description
                            </button>
                            <button class="tab-button py-2 px-1 border-b-2 font-medium text-sm" data-tab="specifications">
                                Specifications
                            </button>
                        </nav>
                    </div>
                    
                    <!-- Tab Content -->
                    <div class="mt-4">
                        <div id="description-tab" class="tab-content">
                            <p class="text-gray-700 leading-relaxed">{{ $item->storeItem->description ?? 'No description available for this item.' }}</p>
                        </div>
                        
                        <div id="specifications-tab" class="tab-content hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Category</span>
                                        <span class="text-gray-900">{{ $item->storeItem->category->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Brand</span>
                                        <span class="text-gray-900">{{ $item->storeItem->brand->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">SKU</span>
                                        <span class="text-gray-900">{{ $item->storeItem->sku ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                
                                <!-- Custom Attributes -->
                                @if($item->storeItem->attributes->count())
                                <div class="space-y-3">
                                    @foreach($item->storeItem->attributes as $attr)
                                        <div class="flex justify-between py-2 border-b border-gray-100">
                                            <span class="font-medium text-gray-600">{{ $attr->attribute->name }}</span>
                                            <span class="text-gray-900">{{ $attr->value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            
                            @if(!$item->storeItem->attributes->count())
                                <div class="text-center py-8 text-gray-500">
                                    <span class="material-symbols-outlined text-4xl mb-2 block opacity-50">info</span>
                                    No additional specifications available.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <div class="mt-auto">
                    @if(auth()->check())
                        @if(!$isInCart)
                            <form method="POST" action="{{ route('cart.add') }}" class="flex flex-col gap-2">
                                @csrf
                                <input type="hidden" name="listing_id" value="{{ $item->id }}">
                                <button type="submit" class="w-full bg-lime-500 hover:bg-lime-600 text-white font-bold py-4 px-8 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <button class="w-full bg-gray-300 text-gray-500 font-bold py-4 px-8 rounded-lg flex items-center justify-center gap-2 shadow-lg cursor-not-allowed" disabled>
                                <span class="material-symbols-outlined">shopping_cart</span>
                                Already in Cart
                            </button>
                        @endif
                    @else
                        <button class="w-full bg-lime-500 hover:bg-lime-600 text-white font-bold py-4 px-8 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl" disabled>
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Add to Cart
                        </button>
                        <p class="text-xs text-gray-500 text-center mt-2">Sign in to add to cart</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Other Listings Section -->
    @if(isset($otherListings) && $otherListings->count())
        <div class="mt-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">More listings for {{ $item->storeItem->title }}</h2>
                <div class="h-1 flex-1 bg-gradient-to-r from-lime-500 to-transparent ml-6 rounded"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($otherListings as $listing)
                    <div class="group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="aspect-square overflow-hidden bg-white flex items-center justify-center">
                                <img src="{{ $listing->storeItem->getImageUrl() }}" alt="{{ $listing->storeItem->title }}" 
                                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="absolute top-3 right-3">
                                <div class="bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                    <span class="text-sm font-bold text-gray-900">${{ $listing->price }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                <a href="{{ route('listing.details', $listing->id) }}" class="hover:text-lime-600 transition-colors">
                                    {{ $listing->storeItem->title ?? '' }}
                                </a>
                            </h3>
                            
                            <div class="space-y-1 text-sm text-gray-600">
                                <div>{{ $listing->storeItem->category->name ?? '' }}</div>
                                <div>Brand: {{ $listing->storeItem->brand->name ?? 'N/A' }}</div>
                                <div class="flex items-center gap-2">
                                    <span>Seller:</span>
                                    @if($listing->user)
                                        <a href="{{ route('profile', ['id' => $listing->user->id]) }}" 
                                           class="text-lime-600 hover:text-lime-700 font-medium">{{ $listing->user->name }}</a>
                                    @else
                                        <span>Unknown</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

    <div class="container mx-auto px-4 py-8">
    <!-- Recommendations Section -->
    <div id="recommendations-section" class="mt-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Recommended for you</h2>
            <div class="h-1 flex-1 bg-gradient-to-r from-lime-500 to-transparent ml-6 rounded"></div>
        </div>

    <div id="recommendations-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Skeleton cards matching "More listings" styles -->
            <div class="group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate-pulse">
                <div class="relative">
                    <div class="aspect-square overflow-hidden bg-gray-100 flex items-center justify-center">
                        <div class="w-full h-full"></div>
                    </div>
                    <div class="absolute top-3 right-3">
                        <div class="bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                            <span class="text-sm font-bold text-gray-900">&nbsp;</span>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                        <span class="block h-4 bg-gray-100 rounded w-3/4"></span>
                    </h3>
                    <div class="space-y-1 text-sm text-gray-600">
                        <div><span class="block h-3 bg-gray-100 rounded w-1/2"></span></div>
                        <div><span class="block h-3 bg-gray-100 rounded w-1/3"></span></div>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate-pulse">
                <div class="relative">
                    <div class="aspect-square overflow-hidden bg-gray-100 flex items-center justify-center">
                        <div class="w-full h-full"></div>
                    </div>
                    <div class="absolute top-3 right-3">
                        <div class="bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                            <span class="text-sm font-bold text-gray-900">&nbsp;</span>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                        <span class="block h-4 bg-gray-100 rounded w-3/4"></span>
                    </h3>
                    <div class="space-y-1 text-sm text-gray-600">
                        <div><span class="block h-3 bg-gray-100 rounded w-1/2"></span></div>
                        <div><span class="block h-3 bg-gray-100 rounded w-1/3"></span></div>
                    </div>
                </div>
            </div>

            <div class="group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate-pulse">
                <div class="relative">
                    <div class="aspect-square overflow-hidden bg-gray-100 flex items-center justify-center">
                        <div class="w-full h-full"></div>
                    </div>
                    <div class="absolute top-3 right-3">
                        <div class="bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                            <span class="text-sm font-bold text-gray-900">&nbsp;</span>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                        <span class="block h-4 bg-gray-100 rounded w-3/4"></span>
                    </h3>
                    <div class="space-y-1 text-sm text-gray-600">
                        <div><span class="block h-3 bg-gray-100 rounded w-1/2"></span></div>
                        <div><span class="block h-3 bg-gray-100 rounded w-1/3"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<!-- Tab Functionality Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetTab = button.getAttribute('data-tab');
            
            // Update button states
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-lime-500', 'text-lime-600');
                btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700');
            });
            
            button.classList.add('active', 'border-lime-500', 'text-lime-600');
            button.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700');
            
            // Update content visibility
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            document.getElementById(targetTab + '-tab').classList.remove('hidden');
        });
    });
    
    // Set initial active state
    const activeButton = document.querySelector('.tab-button.active');
    if (activeButton) {
        activeButton.classList.add('border-lime-500', 'text-lime-600');
        activeButton.classList.remove('border-transparent', 'text-gray-500');
    }
});
</script>

<!-- Recommendations fetch & render script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const recList = document.getElementById('recommendations-list');
    if (!recList) return;

    // Current page item id (single item on this page)
    const itemId = @json($item->id);
    const csrf = '{{ csrf_token() }}';

    console.log('Recommend: sending itemId=', itemId);
    fetch('/recommend', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ items: [itemId] })
    })
    .then(res => res.json())
    .then(data => {
        const recs = data.recommended || [];
        if (!recs.length) {
            recList.innerHTML = '<div class="col-span-3 text-center text-gray-500">No recommendations available.</div>';
            return;
        }

        // Clear skeletons
        recList.innerHTML = '';

    // Render up to 3 recommended items (same markup as "More listings" block)
    // Use /catalog prefix because product detail route is defined as /catalog/{id}
    const listingPrefix = '{{ url("/catalog") }}';
    const profilePrefix = '{{ url("/profile") }}';
        recs.slice(0, 3).forEach(r => {
            const title = r.title || ('Listing ' + (r.listing_id || ''));
            const listingId = r.listing_id || '';
            const img = r.image || '{{ asset("/images/placeholder.png") }}';
            const price = r.price ? ('$' + r.price) : '';

            const card = document.createElement('div');
            card.className = 'group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1';
            card.innerHTML = `
                <a href="${ listingId ? (listingPrefix + '/' + listingId) : '#'}" class="block">
                    <div class="relative">
                        <div class="aspect-square overflow-hidden bg-white flex items-center justify-center">
                            <img src="${img}" alt="${title}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="absolute top-3 right-3">
                            <div class="bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                <span class="text-sm font-bold text-gray-900">${price}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                            <a href="${ listingId ? (listingPrefix + '/' + listingId) : '#'}" class="hover:text-lime-600 transition-colors">${title}</a>
                        </h3>

                        <div class="space-y-1 text-sm text-gray-600">
                            <div>${ r.category || '' }</div>
                            <div>Brand: ${ r.brand || 'N/A' }</div>
                            <div class="flex items-center gap-2">
                                <span>Seller:</span>
                                ${ r.seller_id ? (`<a href="${ profilePrefix + '/' + r.seller_id }" class="text-lime-600 hover:text-lime-700 font-medium">${ r.seller_name || 'Seller' }</a>`) : '<span>Unknown</span>' }
                            </div>
                        </div>
                    </div>
                </a>
            `;

            recList.appendChild(card);
        });
    })
    .catch(err => {
        console.error('Recommend fetch error', err);
        recList.innerHTML = '<div class="col-span-3 text-center text-gray-500">Unable to load recommendations.</div>';
    });
});
</script>
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.tab-button {
    @apply border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300;
}

.tab-button.active {
    @apply border-lime-500 text-lime-600;
}
</style>
@endsection
