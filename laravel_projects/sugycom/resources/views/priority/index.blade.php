@extends('layouts.app')
@section('content')
    <h2>Priorities</h2>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">satellite</th>
                    <th scope="col">target</th>
                    <th scope="col">status</th>
                    <th scope="col">created_at</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($priorities as $priority)
                <tr>
                    <td>{{ $priority->id }}</td>
                    <td>{{ $priority->satellite }}</td>
                    <td>{{ $priority->target }}</td>
                    <td>{{ $priority->status }}</td>
                    <td>{{ $priority->created_at }}</td>
                </tr>
                @empty
                <p>No data.</p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection