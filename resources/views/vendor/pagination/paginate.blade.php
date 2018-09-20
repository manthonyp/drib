@if ($paginator->hasPages())
    <ul class="pagination justify-content-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="prev">
                <span class="page-link round-button dark d-flex justify-content-center" aria-hidden="true">
                    <i class="material-icons" style="margin-right: -5px;padding-left: 5px;">arrow_back_ios</i>
                    <div class="rippleJS"></div>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link round-button dark text-dark d-flex justify-content-center d-flex justify-content-center" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="prev">
                    <i class="material-icons" style="margin-right: -5px;padding-left: 5px;">arrow_back_ios</i>
                    <div class="rippleJS"></div>
                </a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link round-button dark text-dark d-flex justify-content-center mr-0" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="next">
                    <i class="material-icons" style="margin-right: -2px;padding-left: 2px;">arrow_forward_ios</i>
                    <div class="rippleJS"></div>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="next">
                <span class="page-link round-button dark d-flex justify-content-center mr-0" aria-hidden="true">
                    <i class="material-icons" style="margin-right: -2px;padding-left: 2px;">arrow_forward_ios</i>
                    <div class="rippleJS"></div>
                </span>
            </li>
        @endif
    </ul>
@endif
