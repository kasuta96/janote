@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between mb-2">
        <h6 class="text-center"><strong>{{ __('Category') }}</strong></h6>
        <div>
            <span class="dropdown">
                <button class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon i-3dot"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/categories/create">{{ __('Add new category') }}</a>
                </div>
            </span>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{  __('Title') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td><a href="{{ route('notes', $category->id) }}">{{ $category->title }}</a></td>
                <td>
                    <button class="btn-link btn-sm" data-edit="0"><a href="{{ route('editCategory', $category->id) }}">{{ __('Edit')}}</button>
                    @if ($category->user_id == Auth::user()->id)
                        <form action="{{ route('deleteCategory', $category->id) }}" method="get" onsubmit="return checkDelete()">
                            @csrf
                            <button class="btn-link btn-sm" type="submit"><i class="icon i-trash"></i>{{ __('Delete')}}</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
