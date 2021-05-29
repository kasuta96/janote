@extends('layouts.app')

@section('title', 'Page Title')
@section('content')

<div class="">
    @include('post.create')
    @yield('list')
</div>

@endsection