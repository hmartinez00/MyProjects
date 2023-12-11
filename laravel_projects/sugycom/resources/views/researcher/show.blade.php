@extends('layouts.own.app')
@section('content')
    <div class="content">
        <div class='row'>
            <div class="col-sm-6 col-md-6">
                <table class="table-show">
                    <tbody>
                        @foreach ($headers as $header)
                            <tr>
                                <td>{{ $header }}:</td>
                                <td>{{ $researcher->$header }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-sm-6 col-md-6">
                <ul class="dropdown-menu position-static d-grid gap-1 p-2 rounded-3 mx-0 border-0 shadow w-220px" data-bs-theme="dark">
                    <li>
                        <a class="dropdown-item rounded-2" href="{{ route('researcher.edit', $researcher->id) }}">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Edit</font>
                            </font>
                        </a>
                    </li>                    
                    <li>
                        <form action="{{ route('researcher.destroy', $researcher->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="dropdown-item rounded-2" value="Delete">
                        </form>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item rounded-2" href="{{ route('researcher.index') }}">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Back</font>
                            </font>
                        </a>
                    </li> 
                </ul>
            </div>
        </div>
    </div>
@endsection