<div class="border-right vh-100" id="sidebar-wrapper">
    <!-- <div class="sidebar-heading">Start Bootstrap </div> -->
    <div class="overflow-auto h-100 pt-3">

        <!-- Search Form -->
        <form action="{{ route('searchNote') }}" method="get" class="search-form mb-3">
            <input type="text" placeholder="Search" name="kw">
            <button type="submit"><i data-feather="search"></i></button>
        </form>

        <!-- Add button -->
        <div class="p-2">
            <a class="btn btn-success btn-sm btn-block mb-2" href="{{ route('createNote') }}"><i data-feather="plus"></i> {{ __('Note') }}</a>
            <a class="btn btn-success btn-sm btn-block mb-2" href="/categories/create"><i data-feather="plus"></i> {{ __('Categories') }}</a>
        </div>

        <div class="list-group list-group-flush">
            <a href="{{ route('categories') }}" data-menu="categories" class="list-group-item list-group-item-action"><i data-feather="folder"></i> {{ __('Categories') }}</a>
            <a href="{{ route('posts') }}" data-menu="posts" class="list-group-item list-group-item-action"><i data-feather="twitch"></i> {{ __('Community') }}</a>
            <a href="{{ route('trashNote') }}" data-menu="trashNote" class="list-group-item list-group-item-action"><i data-feather="trash-2"></i> {{ __('Trash') }}</a>
        </div>

        @if(Route::is('posts') )
        <div class="text-center footer">
            <div class="text-muted">Pages</div>
            <a class="btn btn-light @if($data->currentPage < 2)disabled @endif" href="{{ route('posts').'/?p='.($data->currentPage-1) }}" role="button">Prev</a>
            <span>{{ $data->currentPage.'/'.$data->totalPage }}</span>
            <a class="btn btn-light @if($data->currentPage >= $data->totalPage)disabled @endif" href="{{ route('posts').'/?p='.($data->currentPage+1) }}" role="button">Next</a>
        </div>
        @endif

    </div>
</div>

<script>
    var sidebar = document.getElementById('sidebar-wrapper');
    sidebar.querySelector('[data-menu="{{ Route::currentRouteName() }}"]').classList.add('active');
</script>