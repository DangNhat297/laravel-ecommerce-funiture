@if (isset($paginator) && $paginator->lastPage() > 1)
<div class="pagination-style-1" data-aos="fade-up" data-aos-delay="200">
    <ul>
        @php
            $interval = isset($interval) ? abs(intval($interval)) : 3;
            $from = $paginator->currentPage() - $interval;
            if ($from < 1) {
                $from = 1;
            }
            
            $to = $paginator->currentPage() + $interval;
            if ($to > $paginator->lastPage()) {
                $to = $paginator->lastPage();
            }
        @endphp
        <!-- first/previous -->
        @if ($paginator->currentPage() > 1)
            <li><a href="{{ $paginator->url($paginator->currentPage() - 1) }}"><i
                        class="ti-angle-double-left"></i></a></li>
        @endif
        @for ($i = $from; $i <= $to; $i++)
            @php
                $isCurrentPage = $paginator->currentPage() == $i;
            @endphp
            <li>
                <a class="{{ $isCurrentPage ? 'active disable' : '' }}" href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
        <!-- next/last -->
        @if ($paginator->currentPage() < $paginator->lastPage())
            <li><a href="{{ $paginator->url($paginator->currentPage() + 1) }}"><i
                        class="ti-angle-double-right"></i></a></li>
        @endif
    </ul>
</div>
@endif