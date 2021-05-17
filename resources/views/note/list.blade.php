@extends('layouts.app')
@section('title', 'Notes')

@section('content')

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
                            <button class="btn btn-light btn-sm" data-edit="0"><i class="icon i-pencil"></i></button>
                            <button class="btn btn-light btn-sm" data-rm="0"><i class="icon i-trash"></i></button>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

@endforeach

</tbody>
</table>

@endsection