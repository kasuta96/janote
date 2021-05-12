<!--- \\\\\\\Create Post-->
<div class="card mb-3">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                    a post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <form action="{{ route('createPost') }}" method="post">
        @csrf
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                    <div class="form-group">
                        <label class="sr-only" for="createPost">post</label>
                        <textarea class="form-control" name="content" id="createPost" rows="3" placeholder="What are you thinking?">{{ old('content') }}</textarea>
                    </div>

                </div>
                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                    <div class="form-group">
                        <div class="custom-file">
                            <!-- <input type="file" class="custom-file-input" id="customFile"> -->
                            <label class="custom-file-label" for="customFile">Upload image</label>
                        </div>
                    </div>
                    <div class="py-4"></div>
                </div>
            </div>
            @if ($errors->has('content'))
            <div class="text-danger mb-3">
                {{ $errors->first('content') }}
            </div>
            @endif
            <div class="btn-toolbar justify-content-between">
                <div class="btn-group">
                    @guest
                    <div>
                        <a class="btn btn-primary" href="{{ route('login') }}" role="button">{{ __('Login') }}</a> to push
                    </div>
                    @endguest
                    @auth
                    <button type="submit" class="btn btn-primary">Push</button>
                    @endauth
                </div>
                <div class="btn-group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-globe"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Post /////-->