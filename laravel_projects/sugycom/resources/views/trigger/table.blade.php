@extends('layouts.own.app')
@section('content')

    <div class="content">
        <a class="ms-5" href="{{ route($views_category . '.index') }}">Back</a>
        <p>{{ $data_item }}</p>
    </div>

@endsection