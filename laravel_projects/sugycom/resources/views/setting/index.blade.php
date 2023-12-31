@extends('layouts.own.app')
@section('content')
    <div class="content">
        {{-- <p>{{ $dir }}</p> --}}
        {{-- <p>{{ $database_status }}</p> --}}
        <p>{{ $py_settings }}</p>
        {{-- <p>{{ $py_scripts }}</p> --}}

        {{-- @foreach ($directoryData as $item)
            <p>{{ htmlspecialchars($item) }}</p>
        @endforeach --}}

    </div>
@endsection