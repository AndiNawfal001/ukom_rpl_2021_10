@if ($paginator->hasPages())
    <div class="join ">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="join-item btn btn-sm btn-disabled">«</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="join-item btn btn-sm">«</a>
        @endif

        {{-- Page Number --}}
        <span class="join-item btn btn-sm">{{ __('Page') }} {{ $paginator->currentPage() }}</span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="join-item btn btn-sm">»</a>
        @else
            <span class="join-item btn btn-sm btn-disabled">»</span>
        @endif
    </div>
@endif
