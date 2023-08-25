@extends('layouts.app')
@section('content')
    <div class="content">
        <h2>Priorities</h2>
        <table class="table-index">
            <thead>
                <tr>
                    <th>id</th>
                    <th>satellite</th>
                    <th>target</th>
                    <th>status</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($priorities as $priority)
                    <tr>
                        <td><a href="{{ route('priority.show', $priority->id) }}">{{ $priority->id }}</a></td>
                        <td><a href="{{ route('priority.show', $priority->id) }}">{{ $priority->satellite }}</a></td>
                        <td><a href="{{ route('priority.show', $priority->id) }}" class="target">{{ $priority->target }}</a></td>
                        <td><a href="{{ route('priority.show', $priority->id) }}">{{ $priority->status }}</a></td>
                        <td><a href="{{ route('priority.show', $priority->id) }}">{{ $priority->created_at }}</a></td>
                    </tr>
                @empty
                    <p>No data.</p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection