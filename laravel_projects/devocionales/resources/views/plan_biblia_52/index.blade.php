@extends('layouts.own.app')
@section('content')   
    <table class="table table-sm table-dark table-hover">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    {{-- <a href="{{ route('dashboard') }}">Home</a> --}}
@endsection
