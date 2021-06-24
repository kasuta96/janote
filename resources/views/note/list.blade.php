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
                    <option value="DESC">{{ __('Newest') }}</option>
                    <option
                        value="ASC"
                        @if(isset($Params['s']) && $Params['s'] == 'ASC')
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
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Content') }}</th>
            @if(!isset($Data->category))
            <th scope="col" class="d-none d-lg-block">{{ __('Categories') }}</th>
            <th scope="col" class="table-tool py-2">
                <a class="btn btn-success btn-sm" href="{{ route('createNote') }}"><i data-feather="plus"></i> {{ __('Add') }}</a>
            </th>
            @else
            <th scope="col" class="table-tool">
                <a class="btn btn-success btn-sm" href="{{ route('createNote',['category'=>$Data->category->id]) }}"><i data-feather="plus"></i> {{ __('Add') }}</a>
            </th>
            @endif
        </tr>
    </thead>
    <tbody>

    @foreach($Notes as $key => $Note)
        <tr>
            <th scope="row" title="{{ $Note->created_at }}">{{ ($Data->page-1)*$Data->limit+$key+1 }}</th>
            <td>{{ $Note->title }}</td>
            <td>{{ $Note->content }}</td>
            @if(!isset($Data->category))
            <td class="d-none d-lg-block"><a class="text-dark" href="{{ route('notes',['c'=>$Note->category_id ?? 'other']) }}">{{ $Note->category->title ?? __('Other') }}</a></td>
            @endif
            <td class="table-tool">

                @include('note.mediaBtn')
                @include('note.noteDropdownBtn')

            </td>
        </tr>
    @endforeach

    </tbody>
</table>

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