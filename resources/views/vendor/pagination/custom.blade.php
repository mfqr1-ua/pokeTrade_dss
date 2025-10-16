@if ($paginator->hasPages())
    <div style="text-align: center; margin-top: 20px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="padding: 8px 12px; margin: 2px; border: 1px solid #ccc; color: #aaa; display: inline-block;">«</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="padding: 8px 12px; margin: 2px; border: 1px solid #ccc; text-decoration: none; color: #333; display: inline-block;">«</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="padding: 8px 12px; margin: 2px; border: 1px solid #ccc; color: #aaa; display: inline-block;">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding: 8px 12px; margin: 2px; background-color: #007bff; color: white; border: 1px solid #007bff; display: inline-block;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" style="padding: 8px 12px; margin: 2px; border: 1px solid #ccc; text-decoration: none; color: #333; display: inline-block;">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="padding: 8px 12px; margin: 2px; border: 1px solid #ccc; text-decoration: none; color: #333; display: inline-block;">»</a>
        @else
            <span style="padding: 8px 12px; margin: 2px; border: 1px solid #ccc; color: #aaa; display: inline-block;">»</span>
        @endif
    </div>
@endif