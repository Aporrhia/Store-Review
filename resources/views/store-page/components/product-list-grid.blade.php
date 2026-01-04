{{-- Product List Grid View --}}
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
    @forelse($items as $item)
        <div class="group relative">
            <div class="w-full overflow-hidden rounded-md bg-white bg-center bg-no-repeat aspect-[3/4] flex items-center justify-center">
                <img src="{{ $item->storeItem->getImageUrl() }}" alt="{{ $item->storeItem->title }}" class="w-full h-full object-contain">
            </div>
            <div class="mt-2 sm:mt-4">
                <div>
                    <h3 class="text-sm sm:text-base font-semibold text-[#141414] line-clamp-2">
                        <a href="{{ route('listing.details', $item->id) }}">
                            <span aria-hidden="true" class="absolute inset-0"></span>
                            {{ $item->storeItem->brand->name . ' ' . $item->storeItem->title ?? '' }}
                        </a>
                    </h3>
                    <p class="mt-1 text-xs sm:text-sm text-gray-500 truncate">{{ $item->storeItem->category->name ?? '-' }}</p>
                    <p class="mt-1 text-xs sm:text-sm text-gray-500 truncate">Brand: {{ $item->storeItem->brand->name ?? '-' }}</p>
                    <p class="text-xs sm:text-sm text-gray-500 mb-1 truncate">Seller: 
                        @if($item->user)
                            <a href="{{ route('profile', ['id' => $item->user->id]) }}" class="text-[#84cc16] font-bold hover:underline">{{ $item->user->name }}</a>
                        @else
                            -
                        @endif
                    </p>
                </div>
                <p class="text-base sm:text-lg font-bold text-gray-900 mt-2">${{ $item->price }}</p>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-500 py-8">No items found for selected filters.</div>
    @endforelse
</div>
