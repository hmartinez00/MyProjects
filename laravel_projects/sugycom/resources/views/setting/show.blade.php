@extends('layouts.own.app')
@section('content')
    <div class="content">
        <a class="ms-5" href="{{ route($views_category . '.index') }}">Back</a>

        @foreach ($param as $item)
            <p>{{ $item }}</p>
        @endforeach

        {{-- <p>{{ $param }}</p> --}}
    </div>
@endsection