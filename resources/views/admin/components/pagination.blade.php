
<div class="pagination-area">

    <ul class="pagination">
        @if ($paginator->onFirstPage())
         @if(!isset($prev))
        <li>
            <a  class="pagination__link" aria-label="{!! __('pagination.previous') !!}"> {!!$prev?? '<i class="w-4 h-4" data-feather="chevrons-left"></i>'!!}</a>
        </li>
        @endif
        <li>
            <a class="pagination__link" aria-label="{!! __('pagination.previous') !!}"> {!!$prev?? '<i class="w-4 h-4" data-feather="chevron-left"></i>'!!} </a>
        </li>
        @else
        @if(!isset($prev))
        <li>
            <a wire:click="prevPage" class="pagination__link" aria-label="{!! __('pagination.previous') !!}"> {!!$prev?? '<i class="w-4 h-4" data-feather="chevrons-left"></i>'!!}</a>
        </li>
        @endif
        <li>
            <a wire:click="prevPage" class="pagination__link" aria-label="{!! __('pagination.previous') !!}"> {!!$prev?? '<i class="w-4 h-4" data-feather="chevron-left"></i>'!!} </a>
        </li>
        @endif
        
        @foreach ($elements as $element)
        @if (is_string($element))
        <li> <a class="pagination__link" href="">{!!$element!!}</a> </li>

        @elseif (is_array($element))
        @foreach ($element as $page => $url)

        <li wire:key="paginator-page{!! $page !!}">
            @if ($page == $paginator->currentPage())

            <a class="pagination__link pagination__link--active active" >{!!$page!!}</a>
            @else

            <a class="pagination__link" wire:click="gotoPage({!! $page !!})" aria-label="{!! __('Go to page :page', ['page' => $page]) !!}">{!!$page!!}</a>
            @endif

        </li>

        @endforeach
        @endif
        @endforeach
        
          @if ($paginator->hasMorePages())
        @if(!isset($prev))
        <li>
            <a class="pagination__link" wire:click="nextPage" dusk="nextPage.before" aria-label="{!! __('pagination.next') !!}"> {!!$next?? '<i class="w-4 h-4" data-feather="chevron-right"></i>'!!} </a>
        </li>
        @endif
        <li>
            <a class="pagination__link" wire:click="nextPage" dusk="nextPage.before" aria-label="{!! __('pagination.next') !!}"> {!!$next?? '<i class="w-4 h-4" data-feather="chevrons-right"></i>'!!} </a>
        </li>
        @else
        @if(!isset($prev))
        <li>
            <a class="pagination__link"  aria-label="{!! __('pagination.next') !!}"> {!!$next?? '<i class="w-4 h-4" data-feather="chevron-right"></i>'!!} </a>
        </li>
        @endif
        <li>
            <a class="pagination__link"   aria-label="{!! __('pagination.next') !!}"> {!!$next?? '<i class="w-4 h-4" data-feather="chevrons-right"></i>'!!} </a>
        </li>
        @endif
        



    </ul>


</div>