@extends('layouts.app')
@section('content')
    <ul>
        @forelse ($priorities as $priority)
            <li>{{ $priority->id }}</li>
        @empty
            <p>No data.</p>
        @endforelse
    </ul>
@endsection