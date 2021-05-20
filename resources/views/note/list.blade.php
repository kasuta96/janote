@extends('layouts.app')
@section('title', 'Notes')

@section('content')

<div class="d-flex justify-content-between mb-2">
    <a href="{{ route('categories') }}" class="btn btn-light">
        <i class="icon i-back"></i> {{ __('Back') }}
    </a>
    <h6 class="text-center"><strong>{{ $Category->title }}</strong></h6>
    <div>
        <span class="dropdown">
            <button class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="icon i-3dot"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('createNote').'?category='.$Category->id }}"><i class="i-plus icon"></i> {{ __('Add') }}</a>
            </div>
        </span>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">タイトル</th>
            <th scope="col">内容</th>
            <!-- <th scope="col">タイプ</th> -->
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

@foreach($Notes as $key => $Note)

        <tr>
            <th scope="row" title="{{ $Note->created_at }}">{{ $key+1 }}</th>
            <td>{{ $Note->title }}</td>
            <td>{{ $Note->content }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-light" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="icon i-3dot"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <button class="btn btn-light btn-sm"><i class="icon i-mic"></i></button>
                            <a href="{{ route('editNote', $Note->id) }}" role="button" class="btn btn-light btn-sm" h><i class="icon i-pencil"></i></a>

                            <form action="{{ route('deleteNote', $Note->id) }}" method="get" class="d-inline-block" onsubmit="return checkDelete()">
                            @csrf
                                <button type="submit" class="btn btn-light btn-sm" title="{{ __('Delete') }}"><i class="icon i-trash"></i></button>
                            </form>

                        </div>
                    </div>
                </div>
            </td>
        </tr>

@endforeach

</tbody>
</table>

@endsection