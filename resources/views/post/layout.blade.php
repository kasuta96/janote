@extends('layouts.app')

@section('title', 'Page Title')
@section('content')

<div class="row">
    <div class="col-md-3">
        @include('layouts.sidebar')
    </div>
    <div class="col-md-6">
        @include('post.create')
        @yield('list')
    </div>
    <div class="col-md-3">
        @include('layouts.rightbar')
    </div>
</div>

@endsection