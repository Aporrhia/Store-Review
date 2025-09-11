<nav aria-label="Breadcrumb" class="text-sm">
    <ol class="inline-flex items-center space-x-1 md:space-x-2">
        <li class="inline-flex items-center">
            <a class="inline-flex items-center text-gray-600 hover:text-[#141414]" href="{{ route('home') }}"> Home
            </a>
        </li>
        @php
            $segments = request()->segments();
            $url = url('/');
        @endphp
        @foreach($segments as $index => $segment)
            @php
                $url .= '/' . $segment;
                $isLast = $index === count($segments) - 1;
            @endphp
            <li>
                <div class="flex items-center">
                    <span class="mx-2 text-gray-400">/</span>
                    @if($isLast)
                        <span class="text-gray-900 capitalize">{{ str_replace('-', ' ', $segment) }}</span>
                    @else
                        <a href="{{ $url }}" class="text-gray-600 hover:text-[#141414] capitalize">{{ str_replace('-', ' ', $segment) }}</a>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>