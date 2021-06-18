@extends('layouts.app')

@section('title', 'Wordtag')
@php
    $params = '?';
    $route = route('hashtag', $Id);

@endphp
@section('content')
<div class="d-flex justify-content-between mb-2">
    <div>
        <a href="{{ route('hashtag') }}" class="btn btn-light">
            <i data-feather="arrow-left"></i> {{ __('Back') }}
        </a>
    </div>
    
</div>
<div class="h4 font-weight-bold mb-0">#{{ Config::get('hashtag')[App::getLocale()][$Id] }}</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Content') }}</th>
            <th scope="col">{{ __('User') }}</th>
            <th scope="col">{{ __('Updated at') }}</th>
        </tr>
    </thead>
    <tbody>

@foreach($Notes as $key => $Note)

        <tr>
            <td>{{ $Note->title }}</td>
            <td>{{ $Note->content }}</td>
            <td>{{ $Note->user->name }}</td>
            <td>{{ $Note->updated_at }}</td>
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
        @for($i=$Data->page-2; $i<$Data->page+3; $i++)
            @if($i>0 && $i<=$Data->totalPage)
            <li class="page-item @if($Data->page==$i)active @endif"><a class="page-link" href="{{ $route.$params.'&p='.$i }}">{{ $i }}</a></li>
            @endif
        @endfor
        <li class="page-item" title="page: {{ $Data->totalPage }}">
            <a class="page-link" href="{{ $route.$params.'&p='.$Data->totalPage }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Last</span>
            </a>
        </li>
    </ul>
</nav>

@endsection