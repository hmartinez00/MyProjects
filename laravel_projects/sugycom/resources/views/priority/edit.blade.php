@extends('layouts.app')
@section('content')
    <div class="content">
        <form method="POST" action="{{ route('priority.update', $priority->id) }}">
            @method('PUT')
            @csrf
            <table class="table-show">
                <tbody>
                    <tr>
                        <td>id:</td>
                        <td><input type="number" name="id" class="form-control" value="{{ $priority->id }}"></td>
                    </tr>
                    <tr>
                        <td>satellite:</td>
                        {{-- <td><input type="text" name="satellite" class="form-control" value="{{ $priority->satellite }}"></td> --}}
                        <td>
                            <select name="satellite" class="form-control">
                                <option value="VRSS-1" {{ $priority->satellite == 'VRSS-1' ? 'selected' : '' }}>VRSS-1</option>
                                <option value="VRSS-2" {{ $priority->satellite == 'VRSS-2' ? 'selected' : '' }}>VRSS-2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>target:</td>
                        <td><input type="text" name="target" class="form-control" value="{{ $priority->target }}"></td>
                    </tr>
                    <tr>
                        <td>latitude:</td>
                        <td><input type="number" name="latitude" class="form-control" step="0.01" value="{{ $priority->latitude }}"></td>
                    </tr>
                    <tr>
                        <td>longitude:</td>
                        <td><input type="number" name="longitude" class="form-control" step="0.01" value="{{ $priority->longitude }}"></td>
                    </tr>
                    <tr>
                        <td>duration:</td>
                        <td><input type="number" name="duration" class="form-control" value="{{ $priority->duration }}"></td>
                    </tr>
                    <tr>
                        <td>vh_angle:</td>
                        <td><input type="number" name="vh_angle" class="form-control" value="{{ $priority->vh_angle }}"></td>
                    </tr>
                    <tr>
                        <td>mode:</td>
                        {{-- <td><input type="text" name="mode" class="form-control" value="{{ $priority->mode }}"></td> --}}
                        <td>
                            <select name="mode" class="form-control">
                                <option value="RealTime" {{ $priority->mode == 'RealTime' ? 'selected' : '' }}>RealTime</option>
                                <option value="Record" {{ $priority->mode == 'Record' ? 'selected' : '' }}>Record</option>
                                <option value="RealTime/Record" {{ $priority->mode == 'RealTime/Record' ? 'selected' : '' }}>RealTime/Record</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>sensor:</td>
                        <td><input type="text" name="sensor" class="form-control" value="{{ $priority->sensor }}"></td>
                    </tr>
                    <tr>
                        <td>status:</td>
                        {{-- <td><input type="text" name="status" class="form-control" value="{{ $priority->status }}"></td> --}}
                        <td>
                            <select name="status" class="form-control">
                                <option value="Baja" {{ $priority->status == 'Baja' ? 'selected' : '' }}>Baja</option>
                                <option value="Media" {{ $priority->status == 'Media' ? 'selected' : '' }}>Media</option>
                                <option value="Alta" {{ $priority->status == 'Alta' ? 'selected' : '' }}>Alta</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>code:</td>
                        <td><input type="text" name="code" class="form-control" value="{{ $priority->code }}"></td>
                    </tr>
                    <tr>
                        <td>created_at:</td>
                        <td><input type="datetime-local" name="created_at" class="form-control" value="{{ $priority->created_at }}"></td>
                    </tr>
                    <tr>
                        <td>updated_at:</td>
                        <td><input type="datetime-local" name="updated_at" class="form-control" value="{{ $priority->updated_at }}"></td>
                    </tr>
                    <tr>
                        <td>closing_date:</td>
                        <td><input type="datetime-local" name="closing_date" class="form-control" value="{{ $priority->closing_date }}"></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn-primary">
                <a href="{{ route('priority.show', $priority->id) }}">Back</a>
            </button>
            <input type="submit" class="btn-primary" value="Update">
        </form>
    </div>
    @endsection