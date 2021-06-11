@extends('layouts.app')
@section('title', 'Notes')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <a href="{{ route('categories') }}" class="btn btn-light">
        <i data-feather="arrow-left"></i> {{ __('Back') }}
    </a>
    <h6 class="text-center"><strong>{{ __('Add') }}</strong></h6>
    <div>
        <!-- <span class="dropdown">
            <button class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">some option</a>
            </div>
        </span> -->
    </div>
</div>

<form action="{{ route('storeNote') }}" method="post" enctype="multipart/form-data">
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
        @if ($errors->has('category_id'))
        <div class="text-danger">
            {{ $errors->first('category_id') }}
        </div>
        @endif

        <label for="">{{ __('Title') }}</label>
        <input type="text" name="title" class="form-control mb-3" placeholder="" value="{{ old('title') }}" aria-describedby="">
        <small class="text-muted"></small>
        @if ($errors->has('title'))
        <div class="text-danger">
            {{ $errors->first('title') }}
        </div>
        @endif

        <label for="">{{ __('Content') }}</label>
        <textarea class="form-control mb-3" name="content" rows="3">{{ old('content') }}</textarea>
        @if ($errors->has('content'))
        <div class="text-danger">
            {{ $errors->first('content') }}
        </div>
        @endif

        <div class="my-4">
            <p>{{ __('Hashtag') }}:</p>
            @foreach (Config::get('hashtag') as $key => $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="hashtag[]" type="checkbox" value="{{ $key }}">
                <label class="form-check-label" for="inlineCheckbox1">{{ $tag }}</label>
            </div>
            @endforeach
        </div>

        <div class="w-100 text-center mb-3">
            <div class="mb-3">
                <i data-feather="image"></i> {{ __('Photo') }}
                <input type="file" name="photo">
                @if ($errors->has('photo'))
                <div class="text-danger">
                    {{ $errors->first('photo') }}
                </div>
                @endif
            </div>
            <div class="mb-3">
                <i data-feather="mic"></i> {{ __('Audio') }}
                <input type="file" accept="audio/*" name="audio">
                @if ($errors->has('photo'))
                <div class="text-danger">
                    {{ $errors->first('photo') }}
                </div>
                @endif
            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-primary w-100 text-center">{{ __('Save') }}</button>
</form>

@endsection