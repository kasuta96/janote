<!--- \\\\\\\Create Post-->
<div class="card mb-5">
    <div class="card-body">
        <form action="{{ route('createPost') }}" method="post">
        @csrf
            <div class="form-group">
                <label class="sr-only" for="createPost">post</label>
                <textarea class="form-control" name="content" rows="3" placeholder="What are you thinking?">{{ old('content') }}</textarea>
            </div>

            <div class="btn-toolbar justify-content-between">
                <div></div>
                <div class="btn-group">
                    @guest
                    <div>
                        <a class="btn btn-primary" href="{{ route('login') }}" role="button">{{ __('Login') }}</a>
                    </div>
                    @endguest
                    @auth
                    <button type="submit" class="btn btn-primary">{{ __('Post') }}</button>
                    @endauth
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Post /////-->