@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<table>
    <thead>
        <tr>
            <th>No.</th><th>タイトル</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $No => $category)
        <tr>
            <td>{{ $No+1 }}</td><td><a href="{{ route('notes', $category->id) }}">{{ $category->title }}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection