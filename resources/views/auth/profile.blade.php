@extends('layouts.app')
@section('title', __('Profile'))
@section('content')

<img class="img-cover mt-n4" src="https://www.gstatic.com/classroom/themes/Psychology.jpg" alt="">
<div class="text-center">
    <div class="avatar-cover mx-auto">
        <img src="{{ $Auth->avatar }}" alt="">
    </div>
    <h3 class="">{{ $Auth->name }}</h3>
    <div class="text-muted">{{ $Auth->email }}</div>
    <a href="{{ route('editProfile') }}" class="btn btn-primary mb-3">{{ __('Edit') }}</a>
    <h5>{{ $Auth->job }}</h5>
    <p>{{ $Auth->description }}</p>
</div>

@endsection
