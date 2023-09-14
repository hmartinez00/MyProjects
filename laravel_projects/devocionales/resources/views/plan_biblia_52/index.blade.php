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
            @forelse ($plan_biblia_52s as $item)
                <tr>
                    @foreach ($headers as $header)
                        <td>{{ $item->$header }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    @foreach ($headers as $header)
                        <td>No data.</td>
                    @endforeach
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- <a href="{{ route('dashboard') }}">Home</a> --}}
@endsection
