@extends('layouts.app')
@section('title', 'Notes')

@section('content')


<form action="{{ route('storeNote') }}" method="post" enctype="multipart/form-data">
@csrf
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('categories') }}" class="btn btn-light">
            <i data-feather="arrow-left"></i> {{ __('Back') }}
        </a>
        <h6 class="text-center"><strong>{{ __('Add') }}</strong></h6>
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>

    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">{{ __('Categories') }}</span>
            </div>
            <select class="form-control" name="category_id" aria-describedby="basic-addon1">
                <option value="" selected>{{ __('Select') }}</option>
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
            <p>{{ __('Hashtag') }}</p>
            @foreach (Config::get('hashtag')[App::getLocale()] as $key => $tag)
            <div class="form-check-inline" onclick="checkboxToggle(this)">
                <input hidden name="tagArr[]" type="checkbox" value="{{ $key }}">
                <label class="badge rounded-pill p-2 bg-secondary text-white" for="inlineCheckbox1">{{ $tag }}</label>
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