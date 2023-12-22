@extends('layouts.own.app')
@section('content')

    <div class="content">

        {{-- <p>{{ $stat }}</p> --}}

        <form 
            action="{{ route('trigger.trigger') }}" method="POST">
            @csrf

            <table class="table table-sm table-dark table-hover">

                <thead>
                    <tr>
                        <th>StartTime</th>
                        <th>EndTime</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <td>
                        <input type="date" name="starttime" class="form-control">
                    </td>
                    <td>
                        <input type="date" name="endtime" class="form-control">
                    </td>
                    <td>
                        <input type="submit" class="btn btn-primary" value="Generate">
                    </td>                
                </tbody>
            </table>
            
        </form>

    </div>

    <form action="#" method="post">
        @csrf
        {{-- @method('DELETE') --}}
        <input type="submit" class="btn btn-success mb-3" value="Download All">
    </form>

    <table class="table table-sm table-dark table-hover">

        <tbody class="table-group-divider">

            @forelse ($files as $file)
                {{-- <p>{{ substr(str_replace("\\", "/", $file), $position) }}</p> --}}
                @if ( $file !== '.' && $file !== '..' )
                    <tr><td>{{ $file }}</td></tr>
                @endif
            @empty
                <tr><td>No data.</td></tr>
            @endforelse

        </tbody>

    </table>

@endsection