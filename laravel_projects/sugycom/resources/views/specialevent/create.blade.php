@extends('layouts.own.app')
@section('content')

    <div class="content">

        <form method="POST" action="{{ route($views_category . '.store') }}">
            @csrf

            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <table class="table-show">
                        <tbody>
                            @foreach ($headers as $header)
                                <tr>
                                    @if ( $header !== 'id' && $header !== 'created_at' && $header !== 'updated_at' )
                                        <td>{{ $header }}:</td>
                                        <td>
                                            @if ( $header == "nombre" )
                                                <select name="nombre" class="form-control">
                                                    @foreach ($options as $option)
                                                        <option value="{{ $option }}">{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                            @elseif ( in_array($header, $headers_text ))        
                                                <input type="text" name="{{ $header }}" class="form-control">
                                            @elseif ( in_array($header, $headers_datetime_local ))
                                                <input type="datetime-local" name="{{ $header }}" class="form-control">                                   
                                            @elseif ( in_array($header, $headers_float ))
                                                <input type="number" name="{{ $header }}" step="0.01" class="form-control">                                   
                                            @else
                                                <input type="number" name="{{ $header }}" class="form-control">
                                            @endif
                                        </td>
                                    @endif
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-6 col-md-6">
                    <ul class="dropdown-menu position-static d-grid gap-1 p-2 rounded-3 mx-0 border-0 shadow w-220px" data-bs-theme="dark">
                        <li>
                            <input type="submit" class="dropdown-item rounded-2" value="Create">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item rounded-2" href="{{ route($views_category . '.index') }}">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Back</font>
                                </font>
                            </a>
                        </li>                    
                    </ul>
                </div>
                
            </div>
            

        </form>

    </div>

@endsection