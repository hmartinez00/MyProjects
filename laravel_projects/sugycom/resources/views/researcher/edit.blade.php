@extends('layouts.own.app')
@section('content')
    <div class="content">

        <form method="POST" action="{{ route('researcher.update', $researcher->id) }}">
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <table class="table-show">
                        <tbody>
                            @foreach ($headers as $header)
                                <tr>
                                    <td>{{ $header }}:</td>
                                    <td>
                                        @if ( in_array($header, $headers_text ))
                                            <input type="text" name="{{ $header }}" class="form-control" value="{{ $researcher->$header }}">
                                        @elseif ( in_array($header, $headers_datetime_local ))
                                            <input type="datetime-local" name="{{ $header }}" class="form-control" value="{{ $researcher->$header }}">
                                        @else
                                            <input type="number" name="{{ $header }}" class="form-control" value="{{ $researcher->$header }}">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                </div>
                
                <div class="col-sm-6 col-md-6">
                    <ul class="dropdown-menu position-static d-grid gap-1 p-2 rounded-3 mx-0 border-0 shadow w-220px" data-bs-theme="dark">

                        <li>
                            <input type="submit" class="dropdown-item rounded-2" value="Update">
                        </li>
                        <li>
                            <a class="dropdown-item rounded-2" href="{{ route('researcher.show', $researcher->id) }}">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Show</font>
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
            
        </form>
        
    </div>
@endsection