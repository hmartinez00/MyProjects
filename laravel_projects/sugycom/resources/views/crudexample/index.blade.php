@extends('layouts.own.app')
@section('content')

    <div class="content">

        <button type="button" class="btn btn-primary m-4">
            <a class="nav-link text-white" href="{{ route($views_category . '.create') }}">Create new item</a>
        </button>
        <table class="table table-sm table-dark table-hover">
            <thead>
                <tr>
                    @foreach ($s_headers as $s_header)
                        <th>{{ $s_header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse ($items as $data_item)
                    <tr>
                        @foreach ($s_headers as $s_header)
                            <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $data_item->id }}">{{ $data_item->$s_header }}</a></td>
                        @endforeach
                        <td>
                            <form method="POST" action="{{ route($views_category . '.destroy', [$views_category => $data_item->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="{{ $data_item->id }}">
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
                                <li><a class="dropdown-item" href="{{ route($views_category . '.show', [$views_category => $data_item->id]) }}">Leer item {{ $data_item->id }}</a></li>
                                <li><a class="dropdown-item" href="{{ route($views_category . '.edit', [$views_category => $data_item->id]) }}">Actualizar item {{ $data_item->id }}</a></li>
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

        <div class="space">
            <form action="{{ route($actions . '.import') }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-success m-2 ms-5 fa-download" value="Import">
            </form>
            <form action="{{ route($actions . '.export') }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-success m-2 ms-5 fa-download" value="Export">
            </form>
        </div>

    </div>
@endsection