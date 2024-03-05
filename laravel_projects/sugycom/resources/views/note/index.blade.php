@extends('layouts.own.app')
@section('content')
<a href="{{ route($views_category . '.create') }}">Create new note</a>
    <ul>
        @forelse ($items as $data_item)
            <li>
                <a href="{{ route($views_category . '.show', [$views_category => $data_item->id]) }}">{{ $data_item->title }}</a>
                <a href="{{ route($views_category . '.edit', [$views_category => $data_item->id]) }}">EDIT</a>
                <form method="POST" action="{{ route($views_category . '.destroy', [$views_category => $data_item->id]) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value='DELETE'>
                </form>
            </li>
        @empty
            <p>No data.</p>
        @endforelse
    </ul>
@endsection