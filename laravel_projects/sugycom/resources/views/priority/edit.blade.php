@extends('layouts.own.app')
@section('content')

<div class="content">

    <form method="POST" action="{{ route($views_category . '.update', [$views_category => $data_item->id]) }}">
        @method('PUT')
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
                                                <option value="VRSS-1" {{ $data_item->satellite == 'VRSS-1' ? 'selected' : '' }}>VRSS-1</option>
                                                <option value="VRSS-2" {{ $data_item->satellite == 'VRSS-2' ? 'selected' : '' }}>VRSS-2</option>
                                            </select>
                                        @elseif ( $header == "mode" )
                                            <select name="mode" class="form-control">
                                                <option value="RealTime" {{ $data_item->mode == 'RealTime' ? 'selected' : '' }}>RealTime</option>
                                                <option value="Record" {{ $data_item->mode == 'Record' ? 'selected' : '' }}>Record</option>
                                                <option value="RealTime/Record" {{ $data_item->mode == 'RealTime/Record' ? 'selected' : '' }}>RealTime/Record</option>
                                            </select>
                                        @elseif ( $header == "status" )
                                            <select name="status" class="form-control">
                                                <option value="Baja" {{ $data_item->status == 'Baja' ? 'selected' : '' }}>Baja</option>
                                                <option value="Media" {{ $data_item->status == 'Media' ? 'selected' : '' }}>Media</option>
                                                <option value="Alta" {{ $data_item->status == 'Alta' ? 'selected' : '' }}>Alta</option>
                                            </select>
                                        @elseif ( in_array($header, $headers_text ))
                                            <input type="text" name="{{ $header }}" class="form-control" value="{{ $data_item->$header }}">
                                        @elseif ( in_array($header, $headers_datetime_local ))
                                            <input type="datetime-local" name="{{ $header }}" class="form-control" value="{{ $data_item->$header }}">
                                        @elseif ( in_array($header, $headers_float ))
                                            <input type="number" name="{{ $header }}" step="0.00001" class="form-control" value="{{ $data_item->$header }}">
                                        @else
                                            <input type="number" name="{{ $header }}" class="form-control" value="{{ $data_item->$header }}">
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
                        <input type="submit" class="dropdown-item rounded-2" value='Update'>
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