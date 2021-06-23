@extends('layouts.app')

@section('title', 'Categories')
@php
    $params = '?';
    $route = route('categories');

@endphp

@section('content')

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
                <td><a href="{{ route('notes', ['c'=>$category->id]) }}">{{ $category->title }}</a></td>
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
