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
                        <td><input type="text" name="id" class="form-control" value="{{ $priority->id }}"></td>
                    </tr>
                    <tr>
                        <td>satellite:</td>
                        <td><input type="text" name="satellite" class="form-control" value="{{ $priority->satellite }}"></td>
                    </tr>
                    <tr>
                        <td>target:</td>
                        <td><input type="text" name="target" class="form-control" value="{{ $priority->target }}"></td>
                    </tr>
                    <tr>
                        <td>latitude:</td>
                        <td><input type="text" name="latitude" class="form-control" value="{{ $priority->latitude }}"></td>
                    </tr>
                    <tr>
                        <td>longitude:</td>
                        <td><input type="text" name="longitude" class="form-control" value="{{ $priority->longitude }}"></td>
                    </tr>
                    <tr>
                        <td>duration:</td>
                        <td><input type="text" name="duration" class="form-control" value="{{ $priority->duration }}"></td>
                    </tr>
                    <tr>
                        <td>vh_angle:</td>
                        <td><input type="text" name="vh_angle" class="form-control" value="{{ $priority->vh_angle }}"></td>
                    </tr>
                    <tr>
                        <td>mode:</td>
                        <td><input type="text" name="mode" class="form-control" value="{{ $priority->mode }}"></td>
                    </tr>
                    <tr>
                        <td>sensor:</td>
                        <td><input type="text" name="sensor" class="form-control" value="{{ $priority->sensor }}"></td>
                    </tr>
                    <tr>
                        <td>status:</td>
                        <td><input type="text" name="status" class="form-control" value="{{ $priority->status }}"></td>
                    </tr>
                    <tr>
                        <td>code:</td>
                        <td><input type="text" name="code" class="form-control" value="{{ $priority->code }}"></td>
                    </tr>
                    <tr>
                        <td>created_at:</td>
                        <td><input type="text" name="created_at" class="form-control" value="{{ $priority->created_at }}"></td>
                    </tr>
                    <tr>
                        <td>updated_at:</td>
                        <td><input type="text" name="updated_at" class="form-control" value="{{ $priority->updated_at }}"></td>
                    </tr>
                    <tr>
                        <td>closing_date:</td>
                        <td><input type="text" name="closing_date" class="form-control" value="{{ $priority->closing_date }}"></td>
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