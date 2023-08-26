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
                        <td><input type="text" name="id" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>satellite:</td>
                        <td><input type="text" name="satellite" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>target:</td>
                        <td><input type="text" name="target" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>latitude:</td>
                        <td><input type="text" name="latitude" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>longitude:</td>
                        <td><input type="text" name="longitude" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>duration:</td>
                        <td><input type="text" name="duration" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>vh_angle:</td>
                        <td><input type="text" name="vh_angle" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>mode:</td>
                        <td><input type="text" name="mode" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>sensor:</td>
                        <td><input type="text" name="sensor" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>status:</td>
                        <td><input type="text" name="status" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>code:</td>
                        <td><input type="text" name="code" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>created_at:</td>
                        <td><input type="text" name="created_at" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>updated_at:</td>
                        <td><input type="text" name="updated_at" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>closing_date:</td>
                        <td><input type="text" name="closing_date" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" class="btn-primary" value="Create">
        </form>
    </div>
@endsection