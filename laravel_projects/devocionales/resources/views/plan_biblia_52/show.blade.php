@extends('layouts.own.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-6">
                <table class="table-show">
                    <tbody>
                        @foreach ($headers as $header)
                        <tr>
                            <td>{{ $header }}:</td>
                            <td>{{ $plan_biblia_52->$header }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-6">

                <ul class="dropdown-menu position-static d-grid gap-1 p-2 rounded-3 mx-0 border-0 shadow w-220px" data-bs-theme="dark">
                    <li>
                        {{-- <a class="dropdown-item rounded-2 active" href="{{ route('plan_biblia_52.edit', $plan_biblia_52->id) }}"> --}}
                        <a class="dropdown-item rounded-2" href="{{ route('plan_biblia_52.edit', $plan_biblia_52->id) }}">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Edit</font>
                            </font>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item rounded-2" href="#">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Send by Telegram</font>
                            </font>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        {{-- <a class="dropdown-item rounded-2" href="{{ route('plan_biblia_52.destroy', $plan_biblia_52->id) }}"> --}}
                            <form action="{{ route('plan_biblia_52.destroy', $plan_biblia_52->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                {{-- <button type="submit" class="btn-danger"> --}}
                                    {{-- <font style="vertical-align: inherit;"> --}}
                                        {{-- <font style="vertical-align: inherit;">Delete</font> --}}
                                    {{-- </font>     --}}
                                {{-- </button> --}}
                                <input type="submit" value="Delete">
                            </form>
                            
                        {{-- </a> --}}
                    </li>
                </ul>

            </div>
        </div>
    </div>
@endsection