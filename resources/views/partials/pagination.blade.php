@if ($data->hasPages())
    <div class="row">
        <div class="col-md-6 align-self-center">
            @php
                $start = ($data->currentPage() - 1) * $data->perPage() + 1;
                $end = min($data->currentPage() * $data->perPage(), $data->total());
            @endphp
            <p class="text-muted">Showing {{ $start }} to {{ $end }} of {{ $data->total() }} entries</p>
        </div>
        <div class="col-md-6">
            <nav>
                <ul class="pagination justify-content-end">
                    @if ($data->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    @foreach ($data->links()->elements[0] as $page => $url)
                        @if ($page == $data->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($data->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif
