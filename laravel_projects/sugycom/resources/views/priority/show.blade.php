@extends('layouts.app')
@section('content')
    <div class="content">
        <table class="table-show">
            <tbody>
                @foreach ($columns as $column)
                    <tr>
                        <td>{{ $column }}:</td>
                        <td>{{ $priority->$column }}:</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('priority.destroy', $priority->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button>
            <button class="btn-primary">
                <a href="{{ route('priority.edit', $priority->id) }}">Edit</a>
            </button>
        </form>
    </div>
@endsection