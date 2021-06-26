<div class="border-right vh-100" id="sidebar-wrapper">
    <!-- <div class="sidebar-heading">Start Bootstrap </div> -->
    <div class="overflow-auto h-100">

        <!-- Add button -->
        <div class="px-2 py-4">
            <a class="btn btn-success btn-block mb-2" data-toggle="modal" data-target="#createNoteModal">
                <i data-feather="plus"></i> {{ __('Note') }}
            </a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-block mb-2" data-toggle="modal" data-target="#createCategories">
                <i data-feather="plus"></i>{{ __('Categories')}}
            </button>
            <button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#showHashtag">
                <i data-feather="tag"></i> {{ __('Word Tag')}}
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
            <a href="{{ route('fcards',['d'=>'fcards','mark'=>1]) }}" data-menu="fcards" class="list-group-item list-group-item-action"><i data-feather="copy"></i> {{ __('Flashcard') }}</a>
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

<!-- create note model -->
<div class="modal fade" id="createNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeNote') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">{{ __('Categories') }}</span>
                            </div>
                            <select class="form-control" name="category_id" aria-describedby="basic-addon1">
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach( App\Http\Controllers\Category\CategoryController::CategoriesData() as $Category)
                                <option value="{{ $Category->id }}">{{ $Category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('category_id'))
                        <div class="text-danger">
                            {{ $errors->first('category_id') }}
                        </div>
                        @endif

                        <label for="">{{ __('Title') }}</label>
                        <input type="text" name="title" class="form-control mb-3" placeholder="" value="{{ old('title') }}" aria-describedby="">
                        <small class="text-muted"></small>
                        @if ($errors->has('title'))
                        <div class="text-danger">
                            {{ $errors->first('title') }}
                        </div>
                        @endif

                        <label for="">{{ __('Content') }}</label>
                        <textarea class="form-control mb-3" name="content" rows="3">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                        <div class="text-danger">
                            {{ $errors->first('content') }}
                        </div>
                        @endif

                        <div class="my-4">
                            <p>{{ __('Hashtag').' ('.__('Share your notes with the world').')' }}</p>
                            @foreach (Config::get('hashtag')[App::getLocale()] as $key => $tag)
                            <div class="form-check-inline" onclick="checkboxToggle(this)">
                                <input hidden name="tagArr[]" type="checkbox" value="{{ $key }}">
                                <label class="badge rounded-pill p-2 bg-secondary text-white" for="inlineCheckbox1">{{ $tag }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="w-100 text-center mb-3">
                            <div class="mb-3">
                                <i data-feather="image"></i> {{ __('Photo') }}
                                <input type="file" name="photo">
                                @if ($errors->has('photo'))
                                <div class="text-danger">
                                    {{ $errors->first('photo') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <i data-feather="mic"></i> {{ __('Audio') }}
                                <input type="file" accept="audio/*" name="audio">
                                @if ($errors->has('photo'))
                                <div class="text-danger">
                                    {{ $errors->first('photo') }}
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var sidebar = document.getElementById('sidebar-wrapper');
    sidebar.querySelector('[data-menu="{{ Route::currentRouteName() }}"]')?.classList.add('active');
</script>