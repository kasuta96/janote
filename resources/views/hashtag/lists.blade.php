@extends('layouts.app')

@section('title', 'Hashtag')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="text-center"><strong>{{ __('Let\'s get a Word Tag')}}！</strong></h5>
        
    </div>
    @foreach (Config::get('hashtag')[App::getLocale()] as $key => $tag)
        <div>
            <a href="{{ route('wordtag', $key) }}">#{{ $tag }}</a>
        </div>
    @endforeach
</div>

@endsection
