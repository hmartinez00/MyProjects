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
        <form method="POST" action="{{ route('plan_biblia_52.store') }}">
            @csrf
            <table class="table-show">
                <tbody>
                    @foreach ($headers as $header)
                        <tr>
                            <td>{{ $header }}:</td>
                            <td>
                                @if ( in_array($header, $headers_text ))
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
            <input type="submit" class="btn-primary" value="Create">
        </form>
    </div>
@endsection