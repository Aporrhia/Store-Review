@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 rounded-md bg-gray-200 text-gray-400 cursor-not-allowed">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-2 rounded-md bg-[#84cc16] text-white hover:bg-gray-800 transition">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-2 rounded-md bg-gray-200 text-gray-400">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 rounded-md bg-[#84cc16] text-white font-bold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-[#84cc16] hover:text-white transition">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-2 rounded-md bg-[#84cc16] text-white hover:bg-gray-800 transition">&raquo;</a>
        @else
            <span class="px-3 py-2 rounded-md bg-gray-200 text-gray-400 cursor-not-allowed">&raquo;</span>
        @endif
    </nav>
@endif