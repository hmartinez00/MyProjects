@extends('layouts.own.app')
@section('content')
    <div class="content">
        <a class="ms-5" href="{{ route($views_category . '.index') }}">Back</a>

        @foreach ($param as $item)
            <p>{{ $item }}</p>
        @endforeach

        {{-- @foreach ($param as $key => $item)
            <p>{{ $key }}</p>
            <p>{{ $item }}</p>
        @endforeach --}}
    </div>
@endsection