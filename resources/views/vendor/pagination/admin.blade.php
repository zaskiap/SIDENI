@if ($paginator->hasPages())
<div style="display:flex;gap:4px;align-items:center">
    @if ($paginator->onFirstPage())
        <span class="admin-page-btn disabled">‹</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="admin-page-btn">‹</a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="admin-page-btn disabled">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="admin-page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="admin-page-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="admin-page-btn">›</a>
    @else
        <span class="admin-page-btn disabled">›</span>
    @endif
</div>
@endif
