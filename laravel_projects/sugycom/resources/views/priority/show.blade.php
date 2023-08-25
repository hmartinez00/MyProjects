@extends('layouts.app')
@section('content')
    <h2>{{ $priority->target }}</h2>
    <ul>
        <li>{{ $priority->id }}</li>
        <li>{{ $priority->satellite }}</li>
        <li>{{ $priority->latitude }}</li>
        <li>{{ $priority->longitude }}</li>
        <li>{{ $priority->duration }}</li>
        <li>{{ $priority->vh_angle }}</li>
        <li>{{ $priority->mode }}</li>
        <li>{{ $priority->sensor }}</li>
        <li>{{ $priority->status }}</li>
        <li>{{ $priority->code }}</li>
        <li>{{ $priority->created_at }}</li>
        <li>{{ $priority->updated_at }}</li>
        <li>{{ $priority->closing_date }}</li>
    </ul>
@endsection