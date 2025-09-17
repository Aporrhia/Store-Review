{{-- Product List List View --}}
<div class="flex flex-col gap-6">
    @forelse($items as $item)
        <div class="flex items-center gap-6 p-4 rounded-md border border-gray-200 bg-white shadow-sm">
            <div class="w-32 h-40 overflow-hidden rounded bg-white-100 flex items-center justify-center">
                <img src="{{ $item->storeItem->getImageUrl() }}" alt="{{ $item->storeItem->title }}" class="w-full h-full object-contain">
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-semibold text-[#141414] mb-1">
                    <a href="#">{{ $item->storeItem->title ?? '' }}</a>
                </h3>
                <p class="text-sm text-gray-500 mb-1">Category: {{ $item->storeItem->category->name ?? '-' }}</p>
                <p class="text-sm text-gray-500 mb-1">Brand: {{ $item->storeItem->brand->name ?? '-' }}</p>
                <p class="text-sm text-gray-500 mb-1">SKU: {{ $item->storeItem->sku ?? '' }}</p>
                <p class="text-sm text-gray-500 mb-1">{{ $item->storeItem->description ?? '' }}</p>
                <p class="text-sm text-gray-500 mb-1">Seller: 
                    @if($item->user)
                        <a href="{{ route('profile', ['id' => $item->user->id]) }}" class="text-[#84cc16] font-bold hover:underline">{{ $item->user->name }}</a>
                    @else
                        -
                    @endif
                </p>
            </div>
            <div class="text-lg font-bold text-gray-900">${{ $item->price }}</div>
        </div>
    @empty
        <div class="text-center text-gray-500 py-8">No items found for selected filters.</div>
    @endforelse
</div>
