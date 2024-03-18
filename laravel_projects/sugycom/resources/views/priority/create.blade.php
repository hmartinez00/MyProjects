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
                                            @if ( $header == "satellite" )
                                                <select name="satellite" class="form-control">
                                                    <option value="VRSS-1">VRSS-1</option>
                                                    <option value="VRSS-2">VRSS-2</option>
                                                </select>    
                                            @elseif ( $header == "mode" )
                                                <select name="mode" class="form-control">
                                                    <option value="RealTime">RealTime</option>
                                                    <option value="Record">Record</option>
                                                    <option value="RealTime/Record">RealTime/Record</option>
                                                </select>
                                            @elseif ( $header == "status" )
                                                <select name="status" class="form-control">
                                                    <option value="Baja">Baja</option>
                                                    <option value="Media">Media</option>
                                                    <option value="Alta">Alta</option>
                                                </select>
                                            @elseif ( in_array($header, $headers_text ))        
                                                <input type="text" name="{{ $header }}" class="form-control">
                                            @elseif ( in_array($header, $headers_datetime_local ))
                                                <input type="datetime-local" name="{{ $header }}" class="form-control">                                   
                                            @elseif ( in_array($header, $headers_float ))
                                                <input type="number" name="{{ $header }}" step="0.00001" class="form-control">
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