@extends('layouts.app')

@section('title', 'Categories')
@php
    $params = '?';
    $route = route('categories');

@endphp

@section('content')
    
<div class="mb-3 row">
    @foreach($categories as $category)
    <div class="col-sm-6 col-lg-4 p-2">
        <div class="card bg-card p-3">
            <a href="{{ route('notes', ['c'=>$category->id]) }}" style="color:black;"><i data-feather="folder"></i> <strong>{{ $category->title }}</strong></a>
            <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                <small class="text-muted">{{ __('Note').': '.$category->count }}</small>
                <div>
                    <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <a class="btn btn-success btn-sm" href="{{ route('editCategory', $category->id) }}" role="button" title="{{ __('Edit')}}"><i data-feather="edit"></i></a>
                        @if ($category->user_id == Auth::user()->id)
                            <form action="{{ route('deleteCategory', $category->id) }}" method="get" class="d-inline-block">
                            @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="{{ __('Delete') }}"><i data-feather="delete"></i></button>
                            </form>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
    <nav aria-label="">
    <ul class="pagination justify-content-center">
        <li class="page-item" title="page: 1">
            <a class="page-link" href="{{ $route.$params.'&p=1' }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">First</span>
            </a>
        </li>
        @for($i=$pagination->page-2; $i<$pagination->page+3; $i++)
            @if($i>0 && $i<=$pagination->totalPage)
            <li class="page-item @if($pagination->page==$i)active @endif"><a class="page-link" href="{{ $route.$params.'&p='.$i }}">{{ $i }}</a></li>
            @endif
        @endfor
        <li class="page-item" title="page: {{ $pagination->totalPage }}">
            <a class="page-link" href="{{ $route.$params.'&p='.$pagination->totalPage }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Last</span>
            </a>
        </li>
    </ul>
    </nav>
@endsection
