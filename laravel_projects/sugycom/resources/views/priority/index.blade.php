@extends('layouts.app')
@section('content')
    <div class="content">
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
                        <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $priority->id }}">{{ $priority->id }}</a></td>
                        <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $priority->id }}">{{ $priority->satellite }}</a></td>
                        <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $priority->id }}"><span class="d-inline-block text-truncate" style="max-width: 150px">{{ $priority->target }}</span></a></td>
                        <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $priority->id }}">{{ $priority->status }}</a></td>
                        <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $priority->id }}">{{ $priority->created_at }}</a></td>
                    </tr>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="{{ $priority->id }}">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menú</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                Acá puede elegir desplegar las caracteristicas del item seleccionado, borrarlo, o crear un nuevo item.
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Dropdown Button
                                </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('priority.show', $priority->id) }}">Mostrar item {{ $priority->id }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('priority.destroy', $priority->id) }}">Borrar item {{ $priority->id }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('priority.create') }}">Crear nuevo item</a></li>
                              </ul>
                            </div>
                        </div>
                    </div>

                @empty
                    <p>No data.</p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection