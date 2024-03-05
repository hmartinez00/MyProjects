@extends('layouts.own.app')
@section('content')
<a href="{{ route($views_category . '.index') }}">Back</a>
    <form method="POST" action="{{ route($views_category . '.update', [$views_category => $data_item->id]) }}">
        @method('PUT')
        @csrf
        {{-- <label>Title:</label>
        <input type="text" name="title" value="{{ $note->title }}">
        <label>Description:</label>
        <input type="text" name="description" value="{{ $note->description }}"> --}}
        @foreach ($headers as $header)
            @if ( $header !== 'id' && $header !== 'created_at' && $header !== 'updated_at' )
                <label>{{ $header }}:</label>
                <input type="text" name="{{ $header }}" class="form-control" value="{{ $data_item->$header }}">
            @endif
        @endforeach
        

        <input type="submit" class="dropdown-item rounded-2" value='Update'>
    </form>
@endsection