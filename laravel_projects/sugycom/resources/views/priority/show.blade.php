@extends('layouts.app')
@section('content')
    <ul>
        <li>{{ $priority->id }}</li>
        <li>{{ $priority->satellite }}</li>
        <li>{{ $priority->target }}</li>
        <li>{{ $priority->latitude }}</li>
        <li>{{ $priority->longitude }}</li>
        <li>{{ $priority->duration }}</li>
        <li>{{ $priority->vh_angle }}</li>
        <li>{{ $priority->mode }}</li>
        <li>{{ $priority->sensor }}</li>
        <li>{{ $priority->status }}</li>
        <li>{{ $priority->code }}</li>
        <li>{{ $priority->closing_date }}</li>
    </ul>
    <a href="{{ route('priority.index') }}"></a>
@endsection