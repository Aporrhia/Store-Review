@extends('layouts.app')
<title>Catalog</title>
@section('content')
<div class="relative flex size-full min-h-screen flex-col overflow-x-hidden group/design-root bg-white"
    style="--checkbox-tick-svg: url('data:image/svg+xml,%3csvg viewBox=%270 0 16 16%27 fill=%27rgb(255,255,255)%27 xmlns=%27http://www.w3.org/2000/svg%27%3e%3cpath d=%27M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z%27/%3e%3c/svg%3e'); font-family: &quot;Plus Jakarta Sans&quot;, &quot;Noto Sans&quot;, sans-serif;">
    <div class="relative flex size-full min-h-screen flex-col overflow-x-hidden group/design-root">
        <div class="flex h-full grow flex-col">

            <main class="flex flex-1">
                <aside class="hidden w-80 border-r border-gray-200 p-8 md:block">
                    <h2 class="text-2xl font-bold tracking-tight text-[#141414]">Filters</h2>
                    <form method="GET" action="{{ route('catalog', []) }}" id="catalogFilterForm">

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Show/hide attribute fields for each category when its checkbox is toggled
    document.querySelectorAll('input[type=checkbox][name="category[]"]').forEach(function(checkbox) {
        var catName = checkbox.value;
        var attrDiv = checkbox.closest('.mb-4').querySelector('.category-attributes');
        function updateVisibility() {
            if (checkbox.checked) {
                if(attrDiv) attrDiv.style.display = '';
            } else {
                if(attrDiv) attrDiv.style.display = 'none';
            }
        }
        checkbox.addEventListener('change', updateVisibility);
        updateVisibility();
    });
});
</script>
                        @if(request('q'))
                            <input type="hidden" name="q" value="{{ is_array(request('q')) ? '' : request('q') }}">
                        @endif
                        <input type="hidden" name="view" value="{{ is_array(request('view')) ? '' : request('view', 'grid') }}">
                        <input type="hidden" name="sort" value="{{ is_array(request('sort')) ? '' : request('sort', '') }}">
                        <input type="hidden" name="per_page" value="{{ is_array(request('per_page')) ? ($perPage ?? 24) : request('per_page', $perPage ?? 24) }}">
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-[#141414]">Category</h3>
                            <div class="mt-4 space-y-3">
                                @foreach($categories as $category)
                                <div class="mb-4 border-b pb-2">
                                    <label class="flex items-center gap-x-3">
                                        <input
                                            class="h-5 w-5 rounded border-2 border-gray-300 bg-transparent text-[#141414] checked:border-[#141414] checked:bg-[#141414] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0"
                                            type="checkbox" name="category[]" value="{{ $category->name }}"
                                            {{ in_array($category->name, request('category',[])) ? 'checked' : '' }} />
                                        <span class="text-base text-gray-800">{{ $category->name }}</span>
                                    </label>
                                    @if($category->attributes->count())
                                    <div class="ml-6 mt-2 space-y-2 category-attributes" style="display:none;">
                                        @foreach($category->attributes as $attribute)
                                            @php
                                                $inputName = 'attribute['.$category->id.']['.$attribute->id.']';
                                                $rawValue = request('attribute')[$category->id][$attribute->id] ?? '';
                                                $inputValue = '';
                                                if (is_array($rawValue)) {
                                                    $inputValue = count($rawValue) ? (string)reset($rawValue) : '';
                                                } else {
                                                    $inputValue = (string)$rawValue;
                                                }
                                            @endphp
                                            <div class="flex flex-col">
                                                <label class="text-sm text-gray-700 font-medium mb-1">{{ $attribute->name }}</label>
                                                @if($attribute->allowed_values && is_array($attribute->allowed_values))
                                                    <select name="{{ $inputName }}" class="rounded border-gray-300 px-2 py-1 focus:ring-2 focus:ring-[#141414] focus:border-[#141414] text-gray-900">
                                                        <option value="">Any</option>
                                                        @foreach($attribute->allowed_values as $option)
                                                            <option value="{{ $option }}" @if($inputValue == $option) selected @endif>{{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                @elseif($attribute->input_type === 'number')
                                                    <input type="number" step="0.01" name="{{ $inputName }}" value="{{ $inputValue }}" class="rounded border-gray-300 px-2 py-1 focus:ring-2 focus:ring-[#141414] focus:border-[#141414] text-gray-900">
                                                @elseif($attribute->input_type === 'text')
                                                    <input type="text" name="{{ $inputName }}" value="{{ $inputValue }}" class="rounded border-gray-300 px-2 py-1 focus:ring-2 focus:ring-[#141414] focus:border-[#141414] text-gray-900">
                                                @elseif($attribute->input_type === 'boolean')
                                                    <select name="{{ $inputName }}" class="rounded border-gray-300 px-2 py-1 focus:ring-2 focus:ring-[#141414] focus:border-[#141414] text-gray-900">
                                                        <option value="">Any</option>
                                                        <option value="1" @if($inputValue==='1') selected @endif>Yes</option>
                                                        <option value="0" @if($inputValue==='0') selected @endif>No</option>
                                                    </select>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-[#141414]">Brand</h3>
                            <div class="mt-4 space-y-3">
                                @foreach(['Wilson','Babolat','Head','Yonex'] as $brand)
                                <label class="flex items-center gap-x-3">
                                    <input
                                        class="h-5 w-5 rounded border-2 border-gray-300 bg-transparent text-[#141414] checked:border-[#141414] checked:bg-[#141414] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0"
                                        type="checkbox" name="brand[]" value="{{ $brand }}"
                                        {{ in_array($brand, request('brand',[])) ? 'checked' : '' }} />
                                    <span class="text-base text-gray-800">{{ $brand }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-[#141414]">Price</h3>
                            <div class="mt-4">
                                <div id="price-slider" class="bg-gray-200 rounded h-2 mb-4"></div>
                                <div class="flex gap-2 mt-2">
                                    <input type="number" step="0.01" id="price_min" name="price_min" class="w-1/2 rounded border-gray-300 px-2 py-1 focus:ring-2 focus:ring-[#141414] focus:border-[#141414] text-gray-900" placeholder="Min" value="{{ is_array(request('price_min')) ? $minPrice : request('price_min', $minPrice) }}">
                                    <input type="number" step="0.01" id="price_max" name="price_max" class="w-1/2 rounded border-gray-300 px-2 py-1 focus:ring-2 focus:ring-[#141414] focus:border-[#141414] text-gray-900" placeholder="Max" value="{{ is_array(request('price_max')) ? $maxPrice : request('price_max', $maxPrice) }}">
                                </div>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit"
                                class="flex h-12 w-full items-center justify-center rounded-md bg-[#141414] px-6 text-sm font-bold text-white hover:bg-gray-800" style="background-color: #84cc16;">
                                Apply Filters
                            </button>
                            <a href="{{ route('catalog') }}{{ request('q') ? '?q='.request('q') : '' }}" class="flex h-12 w-full items-center justify-center rounded-md mt-2 bg-gray-200 px-4 py-2 text-sm font-bold text-gray-700 hover:bg-gray-300">
                                Clear Filters
                            </a>
                        </div>
                    </form>
                </aside>
                <div class="flex-1 p-8">
                    @include('store-page.components.breadcrumbs')
                    <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-[#141414]">Tennis Gear</h1>
                    <div class="mt-8 flex items-center justify-between">
                        <button
                            class="flex items-center gap-2 rounded-md p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 md:hidden">
                            <span class="material-symbols-outlined"> filter_list </span>
                            <span class="text-sm font-medium">Filters</span>
                        </button>
                        <div class="hidden items-center gap-2 md:flex">
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}"
                                class="rounded-md p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 {{ request('view', 'grid') == 'list' ? 'bg-gray-100 text-gray-900' : '' }}">
                                <span class="material-symbols-outlined"> view_list </span>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}"
                                class="rounded-md p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 {{ request('view', 'grid') == 'grid' ? 'bg-gray-100 text-gray-900' : '' }}">
                                <span class="material-symbols-outlined"> grid_view </span>
                            </a>
                        </div>
                        <div class="flex items-center gap-4">
                            <form method="GET" action="{{ route('catalog') }}" id="sortForm" class="flex items-center gap-2">
                                @if(request('q'))
                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                @endif
                                @foreach(request()->except(['sort', 'page', 'per_page', '_token']) as $key => $value)
                                    @if(is_array($value))
                                        @foreach($value as $v)
                                            <input type="hidden" name="{{ $key }}[]" value="{{ is_array($v) ? '' : $v }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="{{ $key }}" value="{{ is_array($value) ? '' : $value }}">
                                    @endif
                                @endforeach
                                <select name="sort" class="flex h-10 items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-4 pr-10 text-sm font-medium text-gray-700 hover:bg-gray-50" onchange="document.getElementById('sortForm').submit()">
                                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sort By</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title: A-Z</option>
                                    <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title: Z-A</option>
                                </select>
                                <select name="per_page" class="flex h-10 items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-4 pr-10 text-sm font-medium text-gray-700 hover:bg-gray-50" onchange="document.getElementById('sortForm').submit()">
                                    @foreach([12, 24, 48] as $option)
                                        <option value="{{ $option }}" {{ $perPage == $option ? 'selected' : '' }}>{{ $option }} per page</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="mt-6">
                        @if(request('view', 'grid') === 'list')
                        @include('store-page.components.product-list-list', ['items' => $items])
                        @else
                        @include('store-page.components.product-list-grid', ['items' => $items])
                        @endif
                        <div class="mt-8 flex justify-center">
                            {{ $items->onEachSide(1)->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
</div>
<!-- noUiSlider CSS -->
<link href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css" rel="stylesheet">
@vite(['resources/js/app.js'])

<!-- noUiSlider JS -->
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var priceSlider = document.getElementById('price-slider');
    var priceMinInput = document.getElementById('price_min');
    var priceMaxInput = document.getElementById('price_max');

    // Always use global min/max from backend for slider range
    var globalMinPrice = parseFloat({{ $minPrice }});
    var globalMaxPrice = parseFloat({{ $maxPrice }});
    // Use filtered values for slider position
    var startMin = parseFloat({{ is_array(request('price_min')) ? $minPrice : request('price_min', $minPrice) }});
    var startMax = parseFloat({{ is_array(request('price_max')) ? $maxPrice : request('price_max', $maxPrice) }});

    noUiSlider.create(priceSlider, {
        start: [startMin, startMax],
        connect: true,
        range: {
            'min': globalMinPrice,
            'max': globalMaxPrice
        },
        step: 0.01,
        tooltips: false,
        format: {
            to: function (value) { return value.toFixed(2); },
            from: function (value) { return parseFloat(value); }
        }
    });

    priceSlider.noUiSlider.on('update', function (values, handle) {
        priceMinInput.value = values[0];
        priceMaxInput.value = values[1];
    });

    priceMinInput.addEventListener('change', function () {
        priceSlider.noUiSlider.set([this.value, null]);
    });
    priceMaxInput.addEventListener('change', function () {
        priceSlider.noUiSlider.set([null, this.value]);
    });

    // Custom styling for slider handles
    setTimeout(function() {
        var handles = priceSlider.querySelectorAll('.noUi-handle');
        handles.forEach(function(handle) {
            handle.classList.add('bg-[#141414]', 'border', 'border-gray-300', 'rounded-full', 'shadow', 'transition', 'duration-150', 'hover:bg-gray-800');
            handle.style.width = '24px';
            handle.style.height = '24px';
            handle.style.top = '-11px';
        });
    }, 100);
});
</script>
@endsection