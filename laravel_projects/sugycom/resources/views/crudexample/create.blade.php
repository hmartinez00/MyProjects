@extends('layouts.own.app')
@section('content')
<a href="{{ route($views_category . '.index') }}">Back</a>
    <form method="POST" action="{{ route($views_category . '.store') }}">
        @csrf
        @foreach ($headers as $header)
            @if ( $header !== 'id' && $header !== 'created_at' && $header !== 'updated_at' )
                @if ( in_array($header, $headers_text ))        
                    <label>{{ $header }}:</label>
                    <input type="text" name="{{ $header }}" class="form-control">
                @elseif ( in_array($header, $headers_datetime_local ))
                    <label>{{ $header }}:</label>
                    <input type="datetime-local" name="{{ $header }}" class="form-control">                                   
                @elseif ( in_array($header, $headers_float ))
                    <label>{{ $header }}:</label>
                    <input type="number" name="{{ $header }}" step="0.01" class="form-control">                                   
                @else
                    <label>{{ $header }}:</label>
                    <input type="number" name="{{ $header }}" class="form-control">
                @endif
            @endif
        @endforeach

        <input type="submit" value='Create'>
    </form>
@endsection