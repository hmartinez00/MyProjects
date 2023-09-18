@extends('layouts.own.app')
@section('content')
    <div class="content">
        <form method="POST" action="{{ route('plan_biblia_52.update', $plan_biblia_52->id) }}">
            @method('PUT')
            @csrf
            <table class="table-show">
                <tbody>
                    @foreach ($headers as $header)
                        <tr>
                            <td>{{ $header }}:</td>
                            <td>
                                @if ( in_array($header, $headers_text ))
                                    <input type="text" name="{{ $header }}" class="form-control" value="{{ $plan_biblia_52->$header }}">
                                @elseif ( in_array($header, $headers_datetime_local ))
                                    <input type="datetime-local" name="{{ $header }}" class="form-control" value="{{ $plan_biblia_52->$header }}">
                                @else
                                    <input type="number" name="{{ $header }}" class="form-control" value="{{ $plan_biblia_52->$header }}">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn-primary">
                <a href="{{ route('plan_biblia_52.show', $plan_biblia_52->id) }}">Back</a>
            </button>
            <input type="submit" class="btn-primary" value="Update">
        </form>
    </div>
@endsection