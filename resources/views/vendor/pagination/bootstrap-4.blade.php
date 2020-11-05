@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="{{ $paginator->toArray()['first_page_url'] }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
            </li>

            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="btn btn-icon btn-sm btn-light-primary mr-2 my-1" aria-hidden="true"><i class="ki ki-bold-arrow-next icon-xs"></i></span>
                </li>
            @endif
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="{{ $paginator->toArray()['last_page_url'] }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
            </li>
        </ul>
    </nav>
@endif
