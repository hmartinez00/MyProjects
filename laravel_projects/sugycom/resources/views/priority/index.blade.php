@extends('layouts.app')
@section('content')
    <div class="content">
        <button class="btn btn-primary">
            <a href="{{ route('priority.create') }}"><i class="fa fa-plus"></i></a>
        </button>
        <h2>Priorities</h2>
        <table class="table table-sm table-dark table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>satellite</th>
                    <th>target</th>
                    <th>status</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($priorities as $priority)
                    <tr>
                        <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#offcanvasExample">{{ $priority->id }}</a></td>
                        <td><a class="nav-link text-white" href="{{ route('priority.show', $priority->id) }}">{{ $priority->satellite }}</a></td>
                        <td><a class="nav-link text-white" href="{{ route('priority.show', $priority->id) }}"><span class="d-inline-block text-truncate" style="max-width: 150px">{{ $priority->target }}</span></a></td>
                        <td><a class="nav-link text-white" href="{{ route('priority.show', $priority->id) }}">{{ $priority->status }}</a></td>
                        <td><a class="nav-link text-white" href="{{ route('priority.show', $priority->id) }}">{{ $priority->created_at }}</a></td>
                    </tr>
                @empty
                    <p>No data.</p>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
              Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
            </div>
            <div class="dropdown mt-3">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Dropdown button
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div>
        </div>
    </div>
@endsection