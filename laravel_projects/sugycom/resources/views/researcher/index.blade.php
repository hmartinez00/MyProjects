{{-- items --}}
{{-- item --}}
@extends('layouts.own.app')
@section('content')
    <div class="content">
        {{-- <button type="button" class="btn btn-primary m-4"> --}}
            {{-- <a class="nav-link text-white" href="{{ route('item.create') }}">Crear nuevo item</a> --}}
        {{-- </button> --}}
        <table class="table table-sm table-dark table-hover">
            <thead>
                <tr>
                    @foreach ($s_headers as $s_header)
                        <th>{{ $s_header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($items as $item)
                    <tr>
                        @foreach ($s_headers as $s_header)
                            @if ($s_header != "target")
                                <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $item->id }}">{{ $item->$s_header }}</a></td>                                
                            @else
                                <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $item->id }}"><span class="d-inline-block text-truncate" style="max-width: 150px">{{ $item->$s_header }}</span></a></td>                                                                
                            @endif
                        @endforeach
                    </tr>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="{{ $item->id }}">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menú</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                Acá puede elegir desplegar las caracteristicas del item seleccionado, actualizarlo o borrarlo.
                            </div>
                            <div class="dropdown mt-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Dropdown Button
                                </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('item.show', $item->id) }}">Leer item {{ $item->id }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('item.edit', $item->id) }}">Actualizar item {{ $item->id }}</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('item.destroy', $item->id) }}">Borrar item {{ $item->id }}</a></li> --}}
                              </ul>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        @foreach ($s_headers as $s_header)
                            <td>No data.</td>
                        @endforeach
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection