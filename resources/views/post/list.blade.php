@extends('post.layout')

@section('list')

@foreach($posts as $post)
<!--- \\\\\\\Post-->
<div class="card mb-3">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                </div>
                <div class="ml-2">
                    <div class="h5 m-0" data-user="{{ $post->user_id }}">{{ $post->user_id.' - '.$post->username }}</div>
                    <div class="h7 text-muted">{{ $post->created_at }}</div>
                </div>
            </div>
            <div>
                <div class="dropdown">
                    <button class="btn btn-link" data-toggle="dropdown" type="button" id="">
                        <i class="icon i-3dot"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                        <div class="h6 dropdown-header">Configuration</div>
                        <a class="dropdown-item" href="#">Save</a>
                        <a class="dropdown-item" href="#">Report</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">
        <p class="card-text">
            {{ $post->content }}
        </p>
    </div>
    <div class="card-footer bg-white">
        <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
    </div>
</div>
<!-- Post /////-->
@endforeach
@endsection