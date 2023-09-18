@extends('layouts.own.app')
@section('content')
    <div class="content">
        <table class="table table-sm table-dark table-hover">
            <thead>
                <tr>
                    @foreach ($s_headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($plan_biblia_52s as $item)
                    <tr>
                        @foreach ($s_headers as $header)
                            <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $item->id }}"><span class="d-inline-block text-truncate" style="max-width: 150px">{{ $item->$header }}</span></a></td>
                        @endforeach
                    </tr>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="{{ $item->id }}">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menú</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <button type="button" class="btn btn-primary mb-4">
                                <a class="nav-link text-white" href="{{ route('plan_biblia_52.create') }}">Crear nuevo item</a>
                            </button>
                            <div>
                                Acá puede elegir desplegar las caracteristicas del item seleccionado, actualizarlo o borrarlo.
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Dropdown Button
                                </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('plan_biblia_52.show', $item->id) }}">Leer item {{ $item->id }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('plan_biblia_52.edit', $item->id) }}">Actualizar item {{ $item->id }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('plan_biblia_52.destroy', $item->id) }}">Borrar item {{ $item->id }}</a></li>
                            </ul>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        @foreach ($s_headers as $header)
                            <td>No data.</td>
                        @endforeach
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
