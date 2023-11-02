@extends('layouts.own.app')
@section('content')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="content">

        <div class="row">
            <div class="col-6">

                <form method="POST" action="{{ route('priority.store') }}">
                    @csrf
                    <table class="table-show">
                        <tbody>
                            @foreach ($headers as $header)
                                <tr>
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
                                        @else
                                            <input type="number" name="{{ $header }}" class="form-control">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <input type="submit" class="btn-primary" value="Create"> --}}
                </form>

            </div>

            <div class="col-6">
                <ul class="dropdown-menu position-static d-grid gap-1 p-2 rounded-3 mx-0 border-0 shadow w-220px" data-bs-theme="dark">
                    {{-- <li>
                        <a class="dropdown-item rounded-2" href="{{ route('priority.create') }}">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">create</font>
                            </font>
                        </a>
                    </li>                     --}}
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('priority.store') }}" method="post">
                            @csrf
                            {{-- @method('DELETE') --}}
                            <input type="submit" class="dropdown-item rounded-2" value="Create">
                        </form>
                    </li>
                </ul>
            </div>

        </div>

    </div>
@endsection