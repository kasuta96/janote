@extends('layouts.app')
@section('title', 'Search')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- <a href="{{ route('categories') }}" class="btn btn-light">
        <i data-feather="arrow-left"></i> {{ __('Back') }}
    </a> -->
    <span class="text-muted">{{ __('Total').': '.$Data->count }}</span>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarTogglerSearch"
        aria-controls="navbarTogglerSearch"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerSearch">
        <form action="{{ route('notes') }}" method="get" class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <div class="form-inline mx-2">
                <input type="hidden" name="d" value="fcard">
                    <input
                        class="form-control"
                        type="search"
                        placeholder="{{ __('Keywords') }}"
                        name="kw" 
                        @if(isset($Params['kw']))
                            value="{{ $Params['kw'] }}"
                        @endif
                    >
                </div>
            </li>
            <li class="nav-item mx-2">
                <select class="form-control" name="c" onchange="javascript:this.form.submit()">
                    <option value="" selected>{{ __('Categories').': '.__('All') }}</option>
                    @foreach( App\Http\Controllers\Category\CategoryController::CategoriesData() as $Category)
                    <option
                        value="{{ $Category->id }}"
                        @if(isset($Data->category) && $Data->category->id==$Category->id)
                            selected 
                        @endif
                    >
                        {{ $Category->title }}
                    </option>
                    @endforeach
                    <option value="other">
                        {{ __('Other') }}
                    </option>

                </select>
            </li>
            <li class="nav-item mx-2">
                <select class="form-control" name="s" onchange="javascript:this.form.submit()">
                    <option value="desc">{{ __('Newest') }}</option>
                    <option
                        value="asc"
                        @if(isset($Params['s']) && $Params['s'] == 'asc')
                            selected
                        @endif
                    >{{ __('Oldest') }}</option>
                </select>
            </li>
            <button class="btn btn-outline-success mx-2" type="submit">{{ __('Search') }}</button>
        </form>
    </div>
</nav>

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
    <div class="card mb-3 p-3">
            <strong>{{ $Note->title }}</strong>
            <p class="descr">{{ $Note->content }}</p>

            @include('note.mediaBtn')

            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">{{ (new App\Classes\General())->shortTime($Note->updated_at) }}</small>
                <div>
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