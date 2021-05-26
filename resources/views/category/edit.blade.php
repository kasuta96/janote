@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between mb-4">
        <a href="/categories" class="btn btn-light">
            <i class="icon i-back"></i> 戻る
        </a>
        <h6 class="text-center"><strong>カテゴリ編集</strong></h6>
        <div>
            <span class="dropbown">
                <button class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon i-3dot"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#">some option</a>
                </div>
            </span>
        </div>
    </div>

    <form action="{{ route('updateCategory') }}" method="POST">
    @csrf
    @method('PATCH')

        <div class="form-group">

            <label for="title">カテゴリ名</label>
            <input type="text" name="title" id="title" class="form-control mb-3" value="{{ $categories->title }}" aria-describedby="helpId">
            

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
        </div>
        <button type="submit" class="btn btn-primary w-100 text-center">保存</button>
    </form>
</div>
@endsection