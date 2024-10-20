@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center items-center space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-gray-200 text-gray-400 rounded-lg cursor-not-allowed">&laquo; Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-white text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-100">
                &laquo; Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-4 py-2 bg-white text-gray-400 rounded-lg">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 bg-blue-500 text-white rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 bg-white text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-white text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-100">
                Next &raquo;
            </a>
        @else
            <span class="px-4 py-2 bg-gray-200 text-gray-400 rounded-lg cursor-not-allowed">Next &raquo;</span>
        @endif
    </nav>
@endif
