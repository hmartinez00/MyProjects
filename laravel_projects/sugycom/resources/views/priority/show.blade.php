@extends('layouts.app')
@section('content')
    <div class="content">
        <h2>{{ $priority->target }}</h2>
        <table class="table-show">
            <tbody>
                <tr>
                    <td>id:</td>
                    <td><input type="text" name="id" class="form-control" value="{{ $priority->id }}"></td>
                </tr>
                <tr>
                    <td>satellite:</td>
                    <td>{{ $priority->satellite }}</td>
                </tr>
                <tr>
                    <td>latitude:</td>
                    <td>{{ $priority->latitude }}</td>
                </tr>
                <tr>
                    <td>longitude:</td>
                    <td>{{ $priority->longitude }}</td>
                </tr>
                <tr>
                    <td>duration:</td>
                    <td>{{ $priority->duration }}</td>
                </tr>
                <tr>
                    <td>vh_angle:</td>
                    <td>{{ $priority->vh_angle }}</td>
                </tr>
                <tr>
                    <td>mode:</td>
                    <td>{{ $priority->mode }}</td>
                </tr>
                <tr>
                    <td>sensor:</td>
                    <td>{{ $priority->sensor }}</td>
                </tr>
                <tr>
                    <td>status:</td>
                    <td>{{ $priority->status }}</td>
                </tr>
                <tr>
                    <td>code:</td>
                    <td>{{ $priority->code }}</td>
                </tr>
                <tr>
                    <td>created_at:</td>
                    <td>{{ $priority->created_at }}</td>
                </tr>
                <tr>
                    <td>updated_at:</td>
                    <td>{{ $priority->updated_at }}</td>
                </tr>
                <tr>
                    <td>closing_date:</td>
                    <td>{{ $priority->closing_date }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection