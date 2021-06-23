@extends('layouts.app')

@section('title', 'Page Title')
@section('content')
<div class="mb-3">
@foreach (Config::get('hashtag')[App::getLocale()] as $key => $tag)
    <span class="m-2">
        <a href="{{ route('wordtag', $key) }}">#{{ $tag }}</a>
    </span>
@endforeach
</div>

<div class="">
    @include('post.create')
    @yield('list')
</div>

@endsection