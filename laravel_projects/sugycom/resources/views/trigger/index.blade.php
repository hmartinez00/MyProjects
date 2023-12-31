@extends('layouts.own.app')
@section('content')

    <div class="content">
        {{-- <p>{{ $test }}</p> --}}

        <form 
            action="{{ route('trigger.trigger') }}" method="POST">
            @csrf

            <table class="table table-sm table-dark table-hover">

                <thead>
                    <tr>
                        {{-- <th></th> --}}
                        <th>StartTime</th>
                        <th>EndTime</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        {{-- <td>
                            <select name="db_status" class="form-control">
                                <option value="True">True</option>
                                <option value="False">False</option>
                            </select> 
                        </td> --}}
                        <td>
                            <input type="date" name="starttime" class="form-control">
                        </td>
                        <td>
                            <input type="date" name="endtime" class="form-control">
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
                        
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="{{ str_replace(" ", "_", $data_item) }}">
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
                                    <li><a class="dropdown-item" href="#">Leer item {{ $data_item }}</a></li>
                                    <li><a class="dropdown-item" href="#">Actualizar item {{ $data_item }}</a></li>
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