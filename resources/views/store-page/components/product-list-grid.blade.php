{{-- Product List Grid View --}}
<div class="grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] gap-x-8 gap-y-12">
    @forelse($items as $item)
        <div class="group relative">
            <div class="w-full overflow-hidden rounded-md bg-white-100 bg-center bg-no-repeat aspect-[3/4] flex items-center justify-center">
                <img src="{{ $item->storeItem->getImageUrl() }}" alt="{{ $item->storeItem->title }}" class="w-full h-full object-contain">
            </div>
            <div class="mt-4 flex justify-between">
                <div>
                    <h3 class="text-base font-semibold text-[#141414]">
                        <a href="{{ route('listing.details', $item->id) }}">
                            <span aria-hidden="true" class="absolute inset-0"></span>
                            {{ $item->storeItem->brand->name . ' ' . $item->storeItem->title ?? '' }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $item->storeItem->category->name ?? '-' }}</p>
                    <p class="mt-1 text-sm text-gray-500">Brand: {{ $item->storeItem->brand->name ?? '-' }}</p>
                    <p class="text-sm text-gray-500 mb-1">Seller: {{ $item->user->name ?? '' }}</p>
                </div>
                <p class="text-base font-medium text-gray-900">${{ $item->price }}</p>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-500 py-8">No items found for selected filters.</div>
    @endforelse
</div>
