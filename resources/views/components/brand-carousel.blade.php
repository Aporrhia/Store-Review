<!-- Brand Carousel Component -->
<div class="bg-white pt-0 pb-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 text-center mb-12">Approved by</h2>
        
        <div class="relative overflow-hidden">
            <!-- Carousel Container -->
            <div class="brand-carousel-wrapper">
                <div class="brand-carousel flex animate-scroll">
                    <!-- First set of brands -->
                    @for($i = 1; $i <= 9; $i++)
                        <div class="flex-shrink-0 w-48 h-24 mx-8 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                            <img src="{{ asset('images/brands/brand' . $i . '.webp') }}" 
                                 alt="Brand {{ $i }}" 
                                 class="max-w-full max-h-16 object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                        </div>
                    @endfor
                    
                    <!-- Duplicate set for seamless loop -->
                    @for($i = 1; $i <= 9; $i++)
                        <div class="flex-shrink-0 w-48 h-24 mx-8 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                            <img src="{{ asset('images/brands/brand' . $i . '.webp') }}" 
                                 alt="Brand {{ $i }}" 
                                 class="max-w-full max-h-16 object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                        </div>
                    @endfor
                    
                    <!-- Third set for extra buffer -->
                    @for($i = 1; $i <= 3; $i++)
                        <div class="flex-shrink-0 w-48 h-24 mx-8 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                            <img src="{{ asset('images/brands/brand' . $i . '.webp') }}" 
                                 alt="Brand {{ $i }}" 
                                 class="max-w-full max-h-16 object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.brand-carousel-wrapper {
    overflow: hidden;
    position: relative;
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        /* Move exactly 9 brands worth of distance */
        transform: translateX(-2304px);
    }
}

.animate-scroll {
    animation: scroll 45s linear infinite;
    will-change: transform;
    /* Ensure smooth rendering */
    transform: translateZ(0);
    backface-visibility: hidden;
    -webkit-font-smoothing: subpixel-antialiased;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-2016px);
        }
    }
    
    .brand-carousel .flex-shrink-0 {
        width: 12rem;
        margin-left: 1rem;
        margin-right: 1rem;
    }
    
    .animate-scroll {
        animation-duration: 35s;
    }
}
</style>