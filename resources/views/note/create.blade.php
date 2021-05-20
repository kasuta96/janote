@extends('layouts.app')
@section('title', 'Notes')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <a href="{{ route('categories') }}" class="btn btn-light">
        <i class="icon i-back"></i> {{ __('Back') }}
    </a>
    <h6 class="text-center"><strong>{{ __('Add') }}</strong></h6>
    <div>
        <!-- <span class="dropdown">
            <button class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="icon i-3dot"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">some option</a>
            </div>
        </span> -->
    </div>
</div>

<form action="{{ route('storeNote') }}" method="post">
@csrf
    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">{{ __('Categories') }}</span>
            </div>
            <select class="form-control" name="category_id" aria-describedby="basic-addon1">
                <option value="" disabled selected>{{ __('Select') }}</option>
                @foreach( $Categories as $Category)
                <option value="{{ $Category->id }}" @if($selected==$Category->id)selected @endif>{{ $Category->title }}</option>
                @endforeach
            </select>
        </div>

        <label for="">{{ __('Title') }}</label>
        <input type="text" name="title" class="form-control mb-3" placeholder="" value="{{ old('title') }}" aria-describedby="">
        <small class="text-muted"></small>

        <label for="">{{ __('Content') }}</label>
        <textarea class="form-control mb-3" name="content" rows="3">{{ old('content') }}</textarea>

        <div class="w-100 text-center mb-3">
            <button type="button" class="btn btn-light"><i class="icon i-mic"></i> {{ __('Recording') }}</button>
            <button type="button" class="btn btn-light"><i class="icon i-image"></i> {{ __('Photo') }}</button>
        </div>

    </div>
    <button type="submit" class="btn btn-primary w-100 text-center">{{ __('Save') }}</button>
</form>

@endsection