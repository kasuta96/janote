@extends('layouts.app')

@section('title', 'Hashtag')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="text-center"><strong>言葉にタグを付けましょう！</strong></h5>
        
    </div>
    @foreach (Config::get('hashtag') as $key => $tag)
        <div>
            <a href="#">#{{ $tag }}</a>
        </div>
    @endforeach
</div>

@endsection