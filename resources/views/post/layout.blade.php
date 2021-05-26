@extends('layouts.app')

@section('title', 'Page Title')
@section('content')

<div class="mx-auto posts-main">
    @include('post.create')
    @yield('list')
</div>

@endsection