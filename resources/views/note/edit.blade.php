@extends('layouts.app')
@section('title', 'Notes')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <a href="{{ route('categories') }}" class="btn btn-light">
        <i data-feather="arrow-left"></i> {{ __('Back') }}
    </a>
    <h6 class="text-center"><strong>{{ __('Edit') }}</strong></h6>
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

<form action="{{ route('updateNote') }}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <input type="hidden" name="id" value="{{ $Note->id }}">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">{{ __('Categories') }}</span>
            </div>
            <select class="form-control" name="category_id" aria-describedby="basic-addon1">
                <option value="" disabled selected>{{ __('Select') }}</option>
                @foreach( $Categories as $Category)
                <option value="{{ $Category->id }}" @if($Note->category_id==$Category->id)selected @endif>{{ $Category->title }}</option>
                @endforeach
            </select>
        </div>
        @if ($errors->has('category_id'))
        <div class="text-danger">
            {{ $errors->first('category_id') }}
        </div>
        @endif

        <label for="">{{ __('Title') }}</label>
        <input type="text" name="title" class="form-control mb-3" placeholder="" value="{{ $Note->title }}" aria-describedby="">
        <small class="text-muted"></small>
        @if ($errors->has('title'))
        <div class="text-danger">
            {{ $errors->first('title') }}
        </div>
        @endif

        <label for="">{{ __('Content') }}</label>
        <textarea class="form-control mb-3" name="content" rows="3">{{ $Note->content }}</textarea>
        @if ($errors->has('content'))
        <div class="text-danger">
            {{ $errors->first('content') }}
        </div>
        @endif

        <div class="my-4">
            <p>{{ __('Hashtag') }}</p>
            @php
                $tagArr = explode(',',$Note->hashtag);
            @endphp
            @foreach (Config::get('hashtag')[App::getLocale()] as $key => $tag)
            <div class="form-check-inline" onclick="checkboxToggle(this)">
                <input hidden name="tagArr[]" type="checkbox" value="{{ $key }}"
                @if(in_array($key,$tagArr))
                    checked
                @endif
                >
                <label
                    @if(in_array($key,$tagArr))
                        class="badge rounded-pill p-2 bg-info text-white"
                    @else
                        class="badge rounded-pill p-2 bg-secondary text-white"
                    @endif
                >
                    {{ $tag }}
                </label>
            </div>
            @endforeach
        </div>


        @if ($Note->image)
        <div class="text-center my-4">
            <img src="{{ $Note->image }}" class="rounded thumb" alt="">
        </div>

        @else
        <div class="w-100 text-center mb-3">
            <i data-feather="image"></i> {{ __('Photo') }}
            <input type="file" name="photo" class="ml-2">
            @if ($errors->has('photo'))
            <div class="text-danger">
                {{ $errors->first('photo') }}
            </div>
            @endif
        </div>
        @endif

        @if ($Note->audio)
        <div class="text-center my-4">
            <figure>
                <figcaption><i data-feather="mic"></i> {{ __('Listen') }}:</figcaption>
                <audio controls src="{{ $Note->audio }}">
                    Your browser does not support the <code>audio</code> element.
                </audio>
            </figure>
        </div>

        @else
        <div class="text-center mb-3">
            <i data-feather="mic"></i> {{ __('Audio') }}
            <input type="file" accept="audio/*" name="audio">
            @if ($errors->has('photo'))
            <div class="text-danger">
                {{ $errors->first('photo') }}
            </div>
            @endif
        </div>
        @endif


        <!-- <div class="w-100 text-center mb-3">
            <button type="button" class="btn btn-light"><i data-feather="mic"></i> {{ __('Recording') }}</button>
            <button type="button" class="btn btn-light"><i data-feather="image"></i> {{ __('Photo') }}</button>
        </div> -->

    </div>
    <button type="submit" class="btn btn-primary w-100 text-center">{{ __('Save') }}</button>
</form>

@endsection