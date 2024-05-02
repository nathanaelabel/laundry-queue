<div class="row">
    <div class="col-md-6 align-self-center">
        @php
            $start = ($data->currentPage() - 1) * $data->perPage() + 1;
            $end = min($data->currentPage() * $data->perPage(), $data->total());
        @endphp
        <p class="text-muted">Showing {{ $start }} to {{ $end }} of {{ $data->total() }} entries</p>
    </div>
    <div class="col-md-6">
        <ul class="pagination justify-content-end">
            <li class="page-item {{ $data->onFirstPage() ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $data->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $data->lastPage(); $i++)
                <li class="page-item {{ $data->currentPage() == $i ? ' active' : '' }}">
                    <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $data->currentPage() == $data->lastPage() ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
</div>
