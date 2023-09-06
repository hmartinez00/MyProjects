@extends('layouts.app')
@section('content')
    <div class="content">
        <form method="POST" action="{{ route('priority.update', $priority->id) }}">
            @method('PUT')
            @csrf
            <table class="table-show">
                <tbody>
                    @foreach ($headers as $header)
                        <tr>
                            <td>{{ $header }}:</td>
                            <td>
                                @if ( $header == "satellite" )
                                    <select name="satellite" class="form-control">
                                        <option value="VRSS-1" {{ $priority->satellite == 'VRSS-1' ? 'selected' : '' }}>VRSS-1</option>
                                        <option value="VRSS-2" {{ $priority->satellite == 'VRSS-2' ? 'selected' : '' }}>VRSS-2</option>
                                    </select>    
                                @elseif ( $header == "mode" )
                                    <select name="mode" class="form-control">
                                        <option value="RealTime" {{ $priority->mode == 'RealTime' ? 'selected' : '' }}>RealTime</option>
                                        <option value="Record" {{ $priority->mode == 'Record' ? 'selected' : '' }}>Record</option>
                                        <option value="RealTime/Record" {{ $priority->mode == 'RealTime/Record' ? 'selected' : '' }}>RealTime/Record</option>
                                    </select>
                                @elseif ( $header == "status" )
                                    <select name="status" class="form-control">
                                        <option value="Baja" {{ $priority->status == 'Baja' ? 'selected' : '' }}>Baja</option>
                                        <option value="Media" {{ $priority->status == 'Media' ? 'selected' : '' }}>Media</option>
                                        <option value="Alta" {{ $priority->status == 'Alta' ? 'selected' : '' }}>Alta</option>
                                    </select>
                                @elseif ( in_array($header, $headers_text ))
                                    <input type="text" name="{{ $header }}" class="form-control" value="{{ $priority->$header }}">
                                @elseif ( in_array($header, $headers_datetime_local ))
                                    <input type="datetime-local" name="{{ $header }}" class="form-control" value="{{ $priority->$header }}">
                                @else
                                    <input type="number" name="{{ $header }}" class="form-control" value="{{ $priority->$header }}">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn-primary">
                <a href="{{ route('priority.show', $priority->id) }}">Back</a>
            </button>
            <input type="submit" class="btn-primary" value="Update">
        </form>
    </div>
@endsection