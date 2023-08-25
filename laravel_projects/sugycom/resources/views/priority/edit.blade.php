@extends('layouts.app')
@section('content')
    <form action="" method="POST">
        @csrf
        <label for="" class="form-label">id:</label>
        <input type="text" name="id" class="form-control" value="{{ $priority->id }}">
        <label for="" class="form-label">satellite:</label>
        <input type="text" name="satellite" class="form-control" value="{{ $priority->satellite }}">
        <label for="" class="form-label">latitude:</label>
        <input type="text" name="latitude" class="form-control" value="{{ $priority->latitude }}">
        <label for="" class="form-label">longitude:</label>
        <input type="text" name="longitude" class="form-control" value="{{ $priority->longitude }}">
        <label for="" class="form-label">duration:</label>
        <input type="text" name="duration" class="form-control" value="{{ $priority->duration }}">
        <label for="" class="form-label">vh_angle:</label>
        <input type="text" name="vh_angle" class="form-control" value="{{ $priority->vh_angle }}">
        <label for="" class="form-label">mode:</label>
        <input type="text" name="mode" class="form-control" value="{{ $priority->mode }}">
        <label for="" class="form-label">sensor:</label>
        <input type="text" name="sensor" class="form-control" value="{{ $priority->sensor }}">
        <label for="" class="form-label">status:</label>
        <input type="text" name="status" class="form-control" value="{{ $priority->status }}">
        <label for="" class="form-label">code:</label>
        <input type="text" name="code" class="form-control" value="{{ $priority->code }}">
        <label for="" class="form-label">created_at:</label>
        <input type="text" name="created_at" class="form-control" value="{{ $priority->created_at }}">
        <label for="" class="form-label">updated_at:</label>
        <input type="text" name="updated_at" class="form-control" value="{{ $priority->updated_at }}">
        <label for="" class="form-label">closing_date:</label>
        <input type="text" name="closing_date" class="form-control" value="{{ $priority->closing_date }}">

    </form>
@endsection