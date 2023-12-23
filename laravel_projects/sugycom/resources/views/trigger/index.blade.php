@extends('layouts.own.app')
@section('content')

    <div class="content">
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
                    <tr>
                        <td>
                            <input type="date" name="starttime" class="form-control">
                        </td>
                        <td>
                            <input type="date" name="endtime" class="form-control">
                        </td>
                        <td>
                            <input type="submit" class="btn btn-primary" value="Generate">
                        </td>                
                    </tr>

                </tbody>
            </table>
            
        </form>


        <table class="table table-sm table-dark table-hover">
            <tbody>
                <tr>
                    <td>
                        <form action="{{ route('trigger.compress') }}" method="POST">
                            @csrf
                            {{-- @method('DELETE') --}}
                            <input type="submit" class="btn btn-success m-2" value="Download All">
                        </form>
                    </td>
                </tr>

                @forelse ($directories as $directory)
                    {{-- <p>{{ substr(str_replace("\\", "/", $file), $position) }}</p> --}}
                    @if ( $directory !== '.' && $directory !== '..' && strpos($directory, '.zip') === false )
                        <tr><td>{{ $directory }}</td></tr>
                    @endif
                @empty
                    <tr><td>No data.</td></tr>
                @endforelse
                
            </tbody>
        </table>
            
    </div>

@endsection