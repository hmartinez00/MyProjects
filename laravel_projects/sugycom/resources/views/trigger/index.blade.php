@extends('layouts.own.app')
@section('content')

    <div class="content">

        <form 
            action="{{ route($views_category . '.trigger') }}" method="POST">
            @csrf

            <table class="table table-sm table-dark table-hover">

                <thead>
                    <tr>
                        <th>StartTime</th>
                        <th>EndTime</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <td>
                            <input type="date" name="starttime" class="form-control" value="{{ str_replace(" ", "" , $starttime) }}">
                        </td>
                        <td>
                            <input type="date" name="endtime" class="form-control" value="{{ str_replace(" ", "" , $endtime) }}">
                        </td>
                        <td>
                            <input type="submit" class="btn btn-primary" value="Generate">
                        </td>                
                    </tr>

                </tbody>
            </table>
            
        </form>

        <table class="table table-sm table-dark table-hover">
            <tbody>
                @forelse ($directories as $data_item)
                    @if ( $data_item !== '.' && $data_item !== '..' && $data_item !== 'data' && $data_item !== 'backup' && strpos($data_item, '.zip') === false )
                        {{-- <tr><td>{{ $data_item }}</td></tr> --}}
                        <tr><td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ str_replace(" ", "_", $data_item) }}">{{ $data_item }}</a></td></tr>
                        
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="{{ str_replace(" ", "_", $data_item)    }}">
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
                                    <li><a class="dropdown-item" href="{{ route($views_category . '.select', $data_item) }}">Seleccionar</a></li>
                                    <li><a class="dropdown-item" href="{{ route($views_category . '.sender', $data_item) }}">Ver directorio</a></li>
                                    <li><a class="dropdown-item" href="{{ route($views_category . '.table', ['param' => 'tcplan', 'data_item' => $data_item]) }}">TCPLAN</a></li>
                                    <li><a class="dropdown-item" href="{{ route($views_category . '.table', ['param' => 'cplan' , 'data_item' => $data_item]) }}">PLAN</a></li>
                                  </ul>
                                </div>
                            </div>
                        </div>


                    @endif
                @empty
                    <tr><td>No data.</td></tr>
                @endforelse
            </tbody>
        </table>
            
    </div>

@endsection