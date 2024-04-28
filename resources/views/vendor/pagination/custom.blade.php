@if ($paginator->hasPages())
    <nav class="flex items-center justify-center mt-4 w-full">
        <ul class="flex items-center justify-between flex-wrap w-full">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 text-gray-500 bg-white border border-gray-300 cursor-not-allowed flex-1 text-center">
                    Previous
                </li>
            @else
                <li class="flex-1 text-center">
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 w-full h-full">
                        Previous
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="{{ $page == $paginator->currentPage() ? 'text-white bg-blue-500' : 'text-gray-700 bg-white hover:bg-gray-100' }} flex-1 text-center">
                            <a href="{{ $url }}" class="px-3 py-2 border border-gray-300 w-full h-full">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="flex-1 text-center">
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 w-full h-full">
                        Next
                    </a>
                </li>
            @else
                <li class="px-3 py-2 text-gray-500 bg-white border border-gray-300 cursor-not-allowed flex-1 text-center">
                    Next
                </li>
            @endif
        </ul>
    </nav>
@endif