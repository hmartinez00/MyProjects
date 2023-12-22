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
                        <input type="submit" value="Generate">
                    </td>                
                </tbody>
            </table>
            
        </form>

    </div>

    @forelse ($files as $file)
        {{-- <p>{{ substr(str_replace("\\", "/", $file), $position) }}</p> --}}
        @if ( $file !== '.' && $file !== '..' )
            <p>{{ $file }}</p>
        @endif
    @empty
        <p>No data.</p>
    @endforelse


@endsection