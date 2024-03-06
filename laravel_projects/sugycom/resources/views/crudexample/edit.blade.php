@extends('layouts.own.app')
@section('content')
<a href="{{ route($views_category . '.index') }}">Back</a>
    <form method="POST" action="{{ route($views_category . '.update', [$views_category => $data_item->id]) }}">
        @method('PUT')
        @csrf
        @foreach ($headers as $header)
            @if ( $header !== 'id' && $header !== 'created_at' && $header !== 'updated_at' )
                <label>{{ $header }}:</label>
                {{-- <input type="text" name="{{ $header }}" class="form-control" value="{{ $data_item->$header }}"> --}}
                @if ( in_array($header, $headers_text ))
                    <input type="text" name="{{ $header }}" class="form-control" value="{{ $data_item->$header }}">
                @elseif ( in_array($header, $headers_datetime_local ))
                    <input type="datetime-local" name="{{ $header }}" class="form-control" value="{{ $data_item->$header }}">
                @elseif ( in_array($header, $headers_float ))
                    <label>{{ $header }}:</label>
                    <input type="number" name="{{ $header }}" step="0.01" class="form-control" value="{{ $data_item->$header }}">                                   
                @else
                    <input type="number" name="{{ $header }}" class="form-control" value="{{ $data_item->$header }}">
                @endif
            @endif
        @endforeach
        

        <input type="submit" class="dropdown-item rounded-2" value='Update'>
    </form>
@endsection