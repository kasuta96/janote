@extends('layouts.app')
@section('title', 'Search')

@section('content')

@include('note.noteNavbar',['RouteName'=>'fcards'])
<div class="pt-3">
    <small class="text-muted ml-3">{{ $Data->count.' '.__('results') }}</small>
    <button class="btn btn-light btn-sm" type="button" onclick="showFcards('.content')">{{ __('Show') }}</button>
    <button class="btn btn-light btn-sm" type="button" onclick="hideFcards('.content')">{{ __('Hide') }}</button>
</div>
@if (!isset($Notes[0]))
<div class="alert alert-info mt-3 text-center" role="alert">
    {{ __('There is no data') }}
    <hr>
    <a
        class="btn btn-success"
        @if(isset($Data->category))
        href="{{ route('createNote',['category'=>$Data->category->id]) }}"
        @else
        href="{{ route('createNote') }}"
        @endif
    >
        <i data-feather="plus"></i> {{ __('Add') }}
    </a>
</div>
@else
<div class="card-columns mt-3">
    @foreach($Notes as $Note)
    <div class="card mb-3 p-3 bg-orange face">
            <strong class="title pointer pb-2" data-toggle="collapse" data-target="#collapse{{ $Note->id }}">{{ $Note->title }}</strong>
            <div class="content show" id="collapse{{ $Note->id }}">{{ $Note->content }}</div>

            <div class="d-flex justify-content-between align-items-center pt-3">
                <button type="button"
                @if ($Note->mark == 2)
                    class="btn btn-primary btn-sm"
                @else
                    class="btn btn-light btn-sm"
                @endif
                    data-id="{{ $Note->id }}" onclick="studied(this)"
                    title="{{ __('Studied') }}"
                >
                    <i data-feather="check"></i>
                </button>

                <div>
                    @include('note.mediaBtn')
                    @include('note.noteDropdownBtn')
                </div>
            </div>
    </div>
    @endforeach

</div>

<nav aria-label="">
    <ul class="pagination justify-content-center">
        <li class="page-item" title="page: 1">
            @php
                $Params['p'] = 1;
            @endphp
            <a class="page-link" href="{{ route('notes', $Params) }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">First</span>
            </a>
        </li>
        @for($i=$Data->page-2; $i<$Data->page+3; $i++)
            @if($i>0 && $i<=$Data->totalPage)
            @php
                $Params['p'] = $i;
            @endphp
            <li class="page-item @if($Data->page==$i)active @endif"><a class="page-link" href="{{ route('notes',$Params) }}">{{ $i }}</a></li>
            @endif
        @endfor
        <li class="page-item" title="page: {{ $Data->totalPage }}">
            @php
                $Params['p'] = $Data->totalPage;
            @endphp
            <a class="page-link" href="{{ route('notes',$Params) }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Last</span>
            </a>
        </li>
    </ul>
</nav>

@endif

@endsection