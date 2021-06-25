@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between mb-4">
        <a href="javascript:history.go(-1)" class="btn btn-light">
            <i class="icon i-back"></i>{{ __('Back') }}
        </a>
        <h6 class="text-center"><strong>{{ __('Edit Category')}}</strong></h6>
        <div>
        </div>
    </div>

    <form action="{{ route('updateCategory', $categories->id) }}" method="POST">
    @csrf
    <!-- method('PATCH') -->

        <div class="form-group">

            <label for="title">{{ __('Name')}}</label>
            <input type="text" name="title" id="title" class="form-control mb-3" value="{{ $categories->title }}" aria-describedby="helpId">
            

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>
        <button type="submit" class="btn btn-primary w-100 text-center">{{ __('Save') }}</button>
    </form>
</div>
@endsection