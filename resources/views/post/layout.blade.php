@extends('layouts.app')

@section('title', 'Page Title')
@section('content')

<div class="row">
    <div class="mx-auto col-md-8 col-lg-7">
        @include('post.create')
        @yield('list')
    </div>
    <div class="col-md-4 col-lg-3">
        @include('layouts.rightbar')
    </div>
</div>

@endsection