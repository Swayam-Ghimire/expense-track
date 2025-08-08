@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-4 border-t border-gray-200 pt-4">
        
        {{-- Left side: Showing results --}}
        <div class="pagination-info">
            Showing results 
            <span class="pagination-text">{{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }}</span>
            to
            <span class="pagination-text">{{ min($paginator->currentPage() * $paginator->perPage(), $paginator->total()) }}</span>
            of
            <span class="pagination-text">{{ $paginator->total() }}</span>
        </div>

        {{-- Right side: Pagination numbers --}}
        <nav class="flex justify-center">
            <ul class="inline-flex -space-x-px text-sm h-7">
                
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="flex items-center justify-center px-7 h-7 leading-tight text-gray-400 bg-white border border-gray-200 rounded-l-lg cursor-not-allowed">
                            ← Prev
                        </span>
                    </li>
                @else
                    <li>
                        <button wire:click="previousPage" class="flex items-center justify-center px-7 h-7 leading-tight bg-white border border-gray-200 text-[#a31621] hover:bg-[#dc2626] hover:text-white rounded-l-lg">
                            ← Prev
                        </button>
                    </li>
                @endif

                {{-- Page Numbers with Ellipsis --}}
                @php
                    $start = max(1, $paginator->currentPage() - 2);
                    $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
                @endphp

                @if ($start > 1)
                    <li>
                        <button wire:click="gotoPage(1)" class="flex items-center justify-center px-7 h-7 leading-tight bg-white border border-gray-200 text-[#a31621] hover:bg-[#dc2626] hover:text-white">
                            1
                        </button>
                    </li>
                    @if ($start > 2)
                        <li>
                            <span class="flex items-center justify-center px-7 h-7 text-gray-400">...</span>
                        </li>
                    @endif
                @endif

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <span class="flex items-center justify-center px-7 h-7 font-semibold border border-[#dc2626] bg-[#dc2626] text-white">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li>
                            <button wire:click="gotoPage({{ $page }})" class="flex items-center justify-center px-7 h-7 leading-tight bg-white border border-gray-200 text-[#a31621] hover:bg-[#dc2626] hover:text-white">
                                {{ $page }}
                            </button>
                        </li>
                    @endif
                @endfor

                @if ($end < $paginator->lastPage())
                    @if ($end < $paginator->lastPage() - 1)
                        <li>
                            <span class="flex items-center justify-center px-7 h-7 text-gray-400">...</span>
                        </li>
                    @endif
                    <li>
                        <button wire:click="gotoPage({{ $paginator->lastPage() }})" class="flex items-center justify-center px-7 h-7 leading-tight bg-white border border-gray-200 text-[#a31621] hover:bg-[#dc2626] hover:text-white">
                            {{ $paginator->lastPage() }}
                        </button>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button wire:click="nextPage" class="flex items-center justify-center px-7 h-7 leading-tight bg-white border border-gray-200 text-[#a31621] hover:bg-[#dc2626] hover:text-white rounded-r-lg">
                            Next →
                        </button>
                    </li>
                @else
                    <li>
                        <span class="flex items-center justify-center px-7 h-7 leading-tight text-gray-400 bg-white border border-gray-200 rounded-r-lg cursor-not-allowed">
                            Next →
                        </span>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
@endif
