<div class="card sticky-top">
    @auth
    <div class="card-body">
        <div class="h5">{{ Auth::user()->name }}</div>
        <div class="h7 text-muted">email: {{ Auth::user()->email }}</div>
    </div>
    @endauth
    <ul class="list-group list-group-flush">

        @if(Route::is('posts') )
        <li class="list-group-item text-center">
            <div class="h6 text-muted">Pages</div>
            <a class="btn btn-light @if($data->currentPage < 2)disabled @endif" href="{{ route('posts').'/?p='.($data->currentPage-1) }}" role="button">Prev</a>
            <span>{{ $data->currentPage.'/'.$data->totalPage }}</span>
            <a class="btn btn-light @if($data->currentPage >= $data->totalPage)disabled @endif" href="{{ route('posts').'/?p='.($data->currentPage+1) }}" role="button">Next</a>
        </li>
        @endif

        <li class="list-group-item">
            <div class="h6 text-muted">somethings...</div>
            <div class="h5"></div>
        </li>
    </ul>
</div>
