@extends('layouts.own.app')
@section('content')

    <div class="content">
        {{-- <p>{{ $test }}</p> --}}

        <form 
            action="{{ route('trigger.trigger') }}" method="POST">
            @csrf

            <table class="table table-sm table-dark table-hover">

                <thead>
                    <tr>
                        {{-- <th></th> --}}
                        <th>StartTime</th>
                        <th>EndTime</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        {{-- <td>
                            <select name="db_status" class="form-control">
                                <option value="True">True</option>
                                <option value="False">False</option>
                            </select> 
                        </td> --}}
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
                @forelse ($directories as $directory)
                    @if ( $directory !== '.' && $directory !== '..' && $directory !== 'data' && $directory !== 'backup' && strpos($directory, '.zip') === false )
                        <tr><td>{{ $directory }}</td></tr>
                    @endif
                @empty
                    <tr><td>No data.</td></tr>
                @endforelse
            </tbody>
        </table>
            
    </div>

@endsection