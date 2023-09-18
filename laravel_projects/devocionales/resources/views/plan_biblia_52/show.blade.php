@extends('layouts.own.app')
@section('content')
    <div class="content">
        <table class="table-show">
            <tbody>
                @foreach ($headers as $header)
                    <tr>
                        <td>{{ $header }}:</td>
                        <td>{{ $plan_biblia_52->$header }}:</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('plan_biblia_52.destroy', $plan_biblia_52->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button>
            <button class="btn-primary">
                <a href="{{ route('plan_biblia_52.edit', $plan_biblia_52->id) }}">Edit</a>
            </button>
        </form>
    </div>
@endsection