<div class="border-right vh-100" id="sidebar-wrapper">
    <!-- <div class="sidebar-heading">Start Bootstrap </div> -->
    <div class="overflow-auto h-100 pt-3">

        <!-- Add button -->
        <div class="p-2">
            <a class="btn btn-success btn-sm btn-block mb-2" href="{{ route('createNote') }}"><i data-feather="plus"></i> {{ __('Note') }}</a>
            <a class="btn btn-success btn-sm btn-block mb-2" href="/categories/create"><i data-feather="plus"></i> {{ __('Categories') }}</a>
        </div>

        <div class="list-group list-group-flush">
            <a href="{{ route('notes') }}" data-menu="notes" class="list-group-item list-group-item-action"><i data-feather="pen-tool"></i> {{ __('Notes') }}</a>
            <div class="btn-group">
                <a href="{{ route('categories') }}" data-menu="categories" class="list-group-item list-group-item-action"><i data-feather="folder"></i> {{ __('Categories') }}</a>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="collapse" data-target="#collapseCate" aria-expanded="true" aria-controls="collapseCate">
                    <span class="sr-only">v</span>
                </button>
            </div>
            <div class="collapse border" id="collapseCate">
                <div class="list-group list-group-flush">
                    @foreach ( App\Http\Controllers\Category\CategoryController::CategoriesData() as $Category)
                    <a href="{{ route('notes', ['c'=>$Category->id]) }}" data-menu-cate="{{ $Category->id }}" class="list-group-item list-group-item-action text-nowrap text-truncate py-1 pl-4 list-group-item-dark">{{ $Category->title }}</a>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('posts') }}" data-menu="posts" class="list-group-item list-group-item-action"><i data-feather="twitch"></i> {{ __('Community') }}</a>
            <a href="{{ route('hashtag') }}" data-menu="hashtag" class="list-group-item list-group-item-action"><i data-feather="tag"></i> {{ __('Word Tag') }}</a>
            <a href="{{ route('trash') }}" data-menu="trash" class="list-group-item list-group-item-action"><i data-feather="trash-2"></i> {{ __('Trash') }}</a>
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
    sidebar.querySelector('[data-menu="{{ Route::currentRouteName() }}"]')?.classList.add('active');
</script>