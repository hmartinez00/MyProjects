@extends('layouts.own.app')
@section('content')
<a href="{{ route($views_category . '.index') }}">Back</a>
    @foreach ($headers as $header)
        @if ( $header !== 'id' && $header !== 'created_at' && $header !== 'updated_at' )
            <li>{{ $header }}: {{ $data_item->$header }}</li>
        @endif
    @endforeach

@endsection