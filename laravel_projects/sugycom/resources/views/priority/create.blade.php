@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="content">
        <form method="POST" action="{{ route('priority.store') }}">
            @csrf
            <table class="table-show">
                <tbody>
                    <tr>
                        <td>id:</td>
                        <td><input type="number" name="id" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>satellite:</td>
                        {{-- <td><input type="text" name="satellite" class="form-control" value="{{ $priority->satellite }}"></td> --}}
                        <td>
                            <select name="satellite" class="form-control">
                                <option value="VRSS-1">VRSS-1</option>
                                <option value="VRSS-2">VRSS-2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>target:</td>
                        <td><input type="text" name="target" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>latitude:</td>
                        <td><input type="number" name="latitude" class="form-control" step="0.01"></td>
                    </tr>
                    <tr>
                        <td>longitude:</td>
                        <td><input type="number" name="longitude" class="form-control" step="0.01"></td>
                    </tr>
                    <tr>
                        <td>duration:</td>
                        <td><input type="number" name="duration" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>vh_angle:</td>
                        <td><input type="number" name="vh_angle" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>mode:</td>
                        {{-- <td><input type="text" name="mode" class="form-control" value="{{ $priority->mode }}"></td> --}}
                        <td>
                            <select name="mode" class="form-control">
                                <option value="RealTime">RealTime</option>
                                <option value="Record">Record</option>
                                <option value="RealTime/Record">RealTime/Record</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>sensor:</td>
                        <td><input type="text" name="sensor" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>status:</td>
                        {{-- <td><input type="text" name="status" class="form-control" value="{{ $priority->status }}"></td> --}}
                        <td>
                            <select name="status" class="form-control">
                                <option value="Baja">Baja</option>
                                <option value="Media">Media</option>
                                <option value="Alta">Alta</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>code:</td>
                        <td><input type="text" name="code" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>created_at:</td>
                        <td><input type="datetime-local" name="created_at" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>updated_at:</td>
                        <td><input type="datetime-local" name="updated_at" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>closing_date:</td>
                        <td><input type="datetime-local" name="closing_date" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" class="btn-primary" value="Create">
        </form>
    </div>
@endsection