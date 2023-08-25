@extends('layouts.app')
@section('content')
    <h2>Priorities</h2>
    <div>
        <table>
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
                        <td><a href="#">{{ $priority->id }}</a></td>
                        <td><a href="#">{{ $priority->satellite }}</a></td>
                        <td><a href="#">{{ $priority->target }}</a></td>
                        <td><a href="#">{{ $priority->status }}</a></td>
                        <td><a href="#">{{ $priority->created_at }}</a></td>
                    </tr>
                @empty
                    <p>No data.</p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection