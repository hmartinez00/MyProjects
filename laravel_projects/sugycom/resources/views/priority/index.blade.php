@extends('layouts.own.app')
@section('content')
    <div class="content">
        <button type="button" class="btn btn-primary m-4">
            <a class="nav-link text-white" href="{{ route('priority.create') }}">Crear nuevo item</a>
        </button>
        <table class="table table-sm table-dark table-hover">
            <thead>
                <tr>
                    @foreach ($selectedHeaders as $selectedHeader)
                        <th>{{ $selectedHeader }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($priorities as $priority)
                    <tr>
                        @foreach ($selectedHeaders as $selectedHeader)
                            @if ($selectedHeader != "target")
                                <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $priority->id }}">{{ $priority->$selectedHeader }}</a></td>                                
                            @else
                                <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $priority->id }}"><span class="d-inline-block text-truncate" style="max-width: 150px">{{ $priority->$selectedHeader }}</span></a></td>                                                                
                            @endif
                        @endforeach
                    </tr>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="{{ $priority->id }}">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menú</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            {{-- <button type="button" class="btn btn-primary mb-4">
                                <a class="nav-link text-white" href="{{ route('priority.create') }}">Crear nuevo item</a>
                            </button> --}}
                            <div>
                                Acá puede elegir desplegar las caracteristicas del item seleccionado, actualizarlo o borrarlo.
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Dropdown Button
                                </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('priority.show', $priority->id) }}">Leer item {{ $priority->id }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('priority.edit', $priority->id) }}">Actualizar item {{ $priority->id }}</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('priority.destroy', $priority->id) }}">Borrar item {{ $priority->id }}</a></li> --}}
                              </ul>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        @foreach ($selectedHeaders as $selectedHeader)
                            <td>No data.</td>
                        @endforeach
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection