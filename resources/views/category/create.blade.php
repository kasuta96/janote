@extends('layouts.app')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between mb-4">
        <a href="/categories" class="btn btn-light">
            <i class="icon i-back"></i> {{ __('Back') }}
        </a>
        <h6 class="text-center"><strong>{{ __('Add new category')}}</strong></h6>
        <div>
        </div>
    </div>

    <form action="{{ route('createCategory') }}" method="POST">
    @csrf
        <div class="form-group">

            <label for="title">{{ __('Name')}}</label>
            <input type="text" name="title" id="title" class="form-control mb-3" placeholder="挨拶..." aria-describedby="helpId">
            

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>
        <button type="submit" class="btn btn-primary w-100 text-center">{{ __('Add')}}</button>
    </form>
</div>
@endsection