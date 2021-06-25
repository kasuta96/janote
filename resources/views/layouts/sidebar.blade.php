<div class="border-right vh-100" id="sidebar-wrapper">
    <!-- <div class="sidebar-heading">Start Bootstrap </div> -->
    <div class="overflow-auto h-100 pt-3">

        <!-- Add button -->
        <div class="p-2">
            <a class="btn btn-success btn-sm btn-block mb-2" href="{{ route('createNote') }}"><i data-feather="plus"></i> {{ __('Note') }}</a>
            <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-sm btn-block mb-2" data-toggle="modal" data-target="#createCategories">
            <i data-feather="plus"></i>{{ __('Categories')}}
        </button>
        <button type="button" class="btn btn-info btn-lg btn-block mb-2" data-toggle="modal" data-target="#showHashtag">
            <i data-feather="tag"></i>{{ __('Word Tag')}}
        </button>
        </div>

        <div class="list-group list-group-flush">
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
            <a href="{{ route('notes') }}" data-menu="notes" class="list-group-item list-group-item-action"><i data-feather="pen-tool"></i> {{ __('Notes') }}</a>
            <a href="{{ route('posts') }}" data-menu="posts" class="list-group-item list-group-item-action"><i data-feather="twitch"></i> {{ __('Community') }}</a>
            <!-- <a href="{{ route('hashtag') }}" data-menu="hashtag" class="list-group-item list-group-item-action"><i data-feather="tag"></i> {{ __('Word Tag') }}</a> -->
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
<!-- Category Modal -->
<div class="modal fade" id="createCategories" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">{{ __('Add new category')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('createCategory') }}" method="POST">
                @csrf
                    <div class="form-group">

                        <label for="title"><h5>{{ __('Name')}}</h5></label>
                        <input type="text" name="title" id="title" class="form-control mb-3" placeholder="{{ __('Categories') }}" aria-describedby="helpId">
                        

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-block">{{ __('Add')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Hashtag Modal -->
<div class="modal fade"  id="showHashtag" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background-image:url('/images/152535.png')">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="exampleModalLabel">{{ __('Let\'s get a Word Tag')}}！</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @foreach (Config::get('hashtag')[App::getLocale()] as $key => $tag)
                <div>
                    <a href="{{ route('wordtag', $key) }}" style="color: #000;"><strong>#{{ $tag }}</strong></a>
                </div>
            @endforeach
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<script>
    var sidebar = document.getElementById('sidebar-wrapper');
    sidebar.querySelector('[data-menu="{{ Route::currentRouteName() }}"]')?.classList.add('active');
</script>