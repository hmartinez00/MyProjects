@extends('layouts.own.app')
@section('content')

    <div class="content">

        <button type="button" class="btn btn-primary m-4">
            <a class="nav-link text-white" href="{{ route($views_category . '.create') }}">Crear nuevo item</a>
        </button>
        <ul>
            @forelse ($items as $data_item)
                <li>
                    @foreach ($s_headers as $s_header)
                        <a href="{{ route($views_category . '.show', [$views_category => $data_item->id]) }}">{{ $data_item->$s_header }}</a>
                    @endforeach
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
    
    </div>
@endsection