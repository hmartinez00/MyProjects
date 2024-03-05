@extends('layouts.own.app')
@section('content')
<a href="{{ route($views_category . '.index') }}">Back</a>
    <form method="POST" action="{{ route($views_category . '.store') }}">
        @csrf
        {{-- <label>Title:</label>
        <input type="text" name="title">
        <label>Description:</label>
        <input type="text" name="description"> --}}
        @foreach ($headers as $header)
            @if ( $header !== 'id' && $header !== 'created_at' && $header !== 'updated_at' )
                <label>{{ $header }}:</label>
                <input type="text" name="{{ $header }}" class="form-control">
            @endif
        @endforeach

        <input type="submit" value='Create'>
    </form>
@endsection