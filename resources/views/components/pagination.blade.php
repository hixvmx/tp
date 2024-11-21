<nav class="mt-6 mb-10">
    @if ($products->hasPages())
        <ul class="flex items-center -space-x-px h-10 text-base">
            <!-- Previous Page -->
            <li>
                <a href="{{ $products->previousPageUrl() }}"
                    class="flex items-center justify-center px-4 h-10 leading-tight {{ $products->onFirstPage() ? 'text-gray-300 pointer-events-none' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} bg-white border border-e-0 border-gray-300 rounded-s-lg"
                    aria-label="Previous">
                    <svg class="w-3 h-3 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                </a>
            </li>

            <!-- Page Links -->
            @foreach ($products->links()->elements[0] as $page => $url)
                <li>
                    <a href="{{ $url }}"
                        class="flex items-center justify-center px-4 h-10 leading-tight {{ $page == $products->currentPage() ? 'text-blue-600 bg-blue-50 border border-blue-300 z-10' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }} border border-gray-300">
                        {{ $page }}
                    </a>
                </li>
            @endforeach

            <!-- Next Page -->
            <li>
                <a href="{{ $products->nextPageUrl() }}"
                    class="flex items-center justify-center px-4 h-10 leading-tight {{ $products->hasMorePages() ? 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' : 'text-gray-300 pointer-events-none' }} bg-white border border-gray-300 rounded-e-lg"
                    aria-label="Next">
                    <svg class="w-3 h-3 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                </a>
            </li>
        </ul>
    @endif
</nav>