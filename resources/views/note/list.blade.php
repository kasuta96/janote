@extends('layouts.app')
@section('title', __('Notes'))

@section('content')
@php
    $params = '?';
    $route = route('notes', $Category->id);

@endphp
<div class="d-flex justify-content-between mb-2">
    <a href="{{ route('categories') }}" class="btn btn-light">
        <i data-feather="arrow-left"></i> {{ __('Back') }}
    </a>
    <h6 class="text-center"><strong>{{ $Category->title }}</strong></h6>
    <div>
        <span class="dropdown">
            <button class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-item disabled text-secondary">
                    <span>{{ __('Total').': '.$Data->count }}</span>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('createNote').'?category='.$Category->id }}"><i data-feather="plus"></i> {{ __('Add') }}</a>
            </div>
        </span>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Content') }}</th>
            <!-- <th scope="col">タイプ</th> -->
            <th scope="col" class="table-tool"></th>
        </tr>
    </thead>
    <tbody>

@foreach($Notes as $key => $Note)

        <tr>
            <th scope="row" title="{{ $Note->created_at }}">{{ ($Data->page-1)*$Data->limit+$key+1 }}</th>
            <td>{{ $Note->title }}</td>
            <td>{{ $Note->content }}</td>
            <td class="table-tool">
                @if ($Note->image)
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#imageModal{{ $Note->id }}" title="{{ __('Photo') }}"><i data-feather="image"></i></button>
                <!-- Modal -->
                <div class="modal fade" id="imageModal{{ $Note->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $Note->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ $Note->image }}" class="rounded img-fluid" alt="" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">
                        <button class="btn btn-light btn-sm"><i data-feather="mic"></i></button>
                        <a href="{{ route('editNote', $Note->id) }}" role="button" class="btn btn-light btn-sm" h><i data-feather="edit"></i></a>

                        <form action="{{ route('deleteNote', $Note->id) }}" method="get" class="d-inline-block" onsubmit="return checkDelete()">
                        @csrf
                            <button type="submit" class="btn btn-light btn-sm" title="{{ __('Delete') }}"><i data-feather="trash"></i></button>
                        </form>

                    </div>
                </div>
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