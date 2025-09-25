@extends('layouts.app')

@section('title', 'Tennis Equipment, Rackets, Strings & Accessories')

@section('content')
<section class="relative h-[640px] bg-cover bg-center bg-no-repeat" style='background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), url("{{ asset('images/banner/banner.webp') }}");'>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter drop-shadow-lg">Elevate Your Game</h1>
        <p class="mt-4 max-w-2xl text-lg md:text-xl font-light drop-shadow-md">Shop the latest tennis gear and apparel designed to perform.</p>
        <a href="{{ route('catalog') }}" class="mt-8 inline-flex items-center justify-center rounded-md bg-lime-500 px-8 py-3 text-base font-bold text-gray-900 shadow-lg transition-transform hover:scale-105 hover:bg-lime-400 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 focus:ring-offset-gray-900">
            Shop Now
        </a>
    </div>
</section>
<section class="py-16 sm:py-24 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 text-center">Shop by Category</h2>
        <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <a class="group" href="{{ route('catalog', ['category' => ['Rackets']]) }}">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white shadow-lg flex items-center justify-center h-56">
                    <img alt="Rackets" class="max-h-52 w-auto object-contain object-center transition-transform group-hover:scale-105" src="{{ asset('images/products/BABOLAT-PURE-AERO.webp') }}" />
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Rackets</h3>
            </a>
            <a class="group" href="#">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white shadow-lg flex items-center justify-center h-56">
                    <img alt="Strings" class="max-h-52 w-auto object-contain object-center transition-transform group-hover:scale-105" src="{{ asset('images/products/head-lynx-tour.webp') }}" />
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Strings</h3>
            </a>
            <a class="group" href="{{ route('catalog', ['category' => ['Balls']]) }}">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white shadow-lg flex items-center justify-center h-56">
                    <img alt="Balls" class="max-h-52 w-auto object-contain object-center transition-transform group-hover:scale-105" src="{{ asset('images/products/YONEX-TOUR.webp') }}" />
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Balls</h3>
            </a>
            <a class="group" href="{{ route('catalog', ['category' => ['Accessories']]) }}">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white shadow-lg flex items-center justify-center h-56">
                    <img alt="Accessories" class="max-h-52 w-auto object-contain object-center transition-transform group-hover:scale-105" src="{{ asset('images/products/WILSON-RF-LEATHER-REPLACEMENT-GRIP-BROWN.webp') }}" />
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Accessories</h3>
            </a>
        </div>
    </div>
</section>
<section class="pt-0 pb-24 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 text-center">Last Listings</h2>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse($latestListings as $listing)
            <a class="group" href="{{ route('listing.details', $listing->id) }}">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-white shadow-lg flex items-center justify-center h-56">
                    <img alt="{{ $listing->storeItem->title }}" class="max-h-52 w-auto object-contain object-center transition-transform group-hover:scale-105" src="{{ $listing->storeItem->getImageUrl() }}" />
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">{{ $listing->storeItem->brand->name ?? '' }} {{ $listing->storeItem->title }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $listing->storeItem->category->name ?? '-' }}</p>
                        <p class="text-sm text-gray-500">Seller: {{ $listing->user->name ?? '-' }}</p>
                    </div>
                    <p class="text-base font-bold text-gray-900">${{ $listing->price }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center text-gray-500 py-8">No listings available.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Brand Carousel Section -->
@include('components.brand-carousel')

<!-- Additional sections (Promotions, Top Brands, etc.) can be added here as in your provided code -->
@endsection
