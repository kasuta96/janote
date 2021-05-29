@extends('layouts.app')
@section('title',config('app.name'))

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<h5>Hi! {{ Auth::user()->name }}</h5>
<div class="card bg-info mb-4">
    <div class="card-header text-white">{{ __('Recent') }}</div>
    <div class="card-body card-columns">
        @foreach($Notes as $Note)
        <div class="card bg-light mb-3">
            <div class="pt-3 px-3">
                <strong>{{ $Note->title }}</strong>
                <p class="descr">{{ $Note->content }}</p>
                <div class="d-flex justify-content-between">
                    <div>
                        @include('note.mediaBtn')
                    </div>
                    <small class="text-muted">{{ $Note->shortTime }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
