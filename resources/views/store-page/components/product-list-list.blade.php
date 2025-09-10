{{-- Product List List View --}}
<div class="flex flex-col gap-6">
    @forelse($items as $item)
        <div class="flex items-center gap-6 p-4 rounded-md border border-gray-200 bg-white shadow-sm">
            <div class="w-32 h-40 overflow-hidden rounded bg-cover bg-center"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAAROJvHVQcfBZXJ1g2b3ynng1Uo3rts3-boOLuSziQK_JVInDnqIhueCa4fFOx6cJlwFnHINLhMCqKpQVIJozPSSQLlRDS2bSYSnLuQ3XH2w_FKFxQErVwjK0U5StUIbzhBak6EejvRyH7_BevF6u3CxrS8eRpx4Ewzra7OQQHYtwQPt4jK0lzcW8_sU6ZTNVkDZUqRmp6eLrhArfET6ECgxnRs8JQMgctFEoTzWR1IEqBdNHr4o7iX3WUhz_54qPrgaNviksirxU");'>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-semibold text-[#141414] mb-1">
                    <a href="#">{{ $item->title }}</a>
                </h3>
                <p class="text-sm text-gray-500 mb-1">Category: {{ $item->category ?? '' }}</p>
                <p class="text-sm text-gray-500 mb-1">Brand: {{ $item->brand ?? '' }}</p>
                <p class="text-sm text-gray-500 mb-1">SKU: {{ $item->sku ?? '' }}</p>
                <p class="text-sm text-gray-500 mb-1">{{ $item->description ?? '' }}</p>
            </div>
            <div class="text-lg font-bold text-gray-900">${{ $item->price }}</div>
        </div>
    @empty
        <div class="text-center text-gray-500 py-8">No items found for selected filters.</div>
    @endforelse
</div>
