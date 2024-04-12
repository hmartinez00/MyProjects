@extends('layouts.own.app')
@section('content')

    <div class="content">
        
        <div class='row'>
            <div class="col-sm-8 col-md-8">
                <button type="button" class="btn btn-primary m-4">
                    <a class="nav-link text-white" href="{{ route($views_category . '.create') }}">Create new item</a>
                </button>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <form action="{{ route($actions . '.import') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success m-2 ms-5 nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0"/>
                                <path d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4"/>
                            </svg>
                            Import
                        </button>
                    </form>
                    <form action="{{ route($actions . '.export') }}" method="POST">
                    {{-- <form action="{{ route($views_category . '.export') }}" method="POST"> --}}
                        @csrf
                        <button type="submit" class="btn btn-success m-2 ms-5 nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                            </svg>
                            Export
                        </button>
                    </form>
                </div>
            </div>
        </div>


        <div class='row'>
            <div class="col-sm-12 col-md-12">

                <table class="table table-sm table-dark table-hover">
                    <thead>
                        <tr>
                            @foreach ($s_headers as $s_header)
                                <th>{{ $s_header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        @forelse ($items as $data_item)
                            <tr>
                                @foreach ($s_headers as $s_header)
                                    <td><a class="nav-link text-white" data-bs-toggle="offcanvas" href="#{{ $data_item->id }}">{{ $data_item->$s_header }}</a></td>
                                @endforeach
                                <td>
                                    <form method="GET" action="{{ route($views_category . '.show', [$views_category => $data_item->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="offcanvas offcanvas-start" tabindex="-1" id="{{ $data_item->id }}">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Special options</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div>
                                        Here you can choose to display the special characteristics of the selected item.</div>
                                    <div class="dropdown mt-3">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Dropdown Button
                                        </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form method="POST" action="{{ route($views_category . '.sendTelegramMessage', $data_item->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary m-2 mt-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                                                    </svg>
                                                    Send message {{ $data_item->id }} by Telegram
                                                </button>
                                            </form>
                                        </li>
                                        {{-- <li>
                                            <form method="POST" action="{{ route($views_category . '.mailme', $data_item->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success m-2 mt-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
                                                        <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
                                                        <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
                                                    </svg>
                                                    Send message {{ $data_item->id }} by Mail
                                                </button>
                                            </form>
                                        </li> --}}
                                        <li>
                                            <form method="POST" action="{{ route($views_category . '.destroy', [$views_category => $data_item->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger m-2 mt-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                    </svg>
                                                    Delete item {{ $data_item->id }}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div>


                        @empty
                            <tr>
                                @foreach ($s_headers as $s_header)
                                    <td>No data.</td>
                                @endforeach
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        
        </div>

        <div class='row'>
            <div class="col-sm-2 col-md-2"></div>
            <div class="col-sm-2 col-md-2">
                <div class="dropdown">
                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Rows
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($rowsList_dropdown as $row)
                            <li class="page-item"><a class="page-link pr-2" href="{{ route($actions . '.show_rows', ['param' => $row]) }}">{{ $row }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <nav aria-label="...">
                    <ul class="pagination">

                        @if ( $status[0] == TRUE )                            
                            <li class="page-item">
                                <a class="page-link" href="{{ route($actions . '.show_rows', ['param' => $rowsList[0] - 1]) }}">Previous</a>
                            </li>                            
                        @else                            
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                        @endif

                        @foreach ($rowsList as $row)
                            <li class="page-item"><a class="page-link" href="{{ route($actions . '.show_rows', ['param' => $row]) }}">{{ $row }}</a></li>
                        @endforeach
                       
                        @if ( $status[1] == TRUE )                            
                            <li class="page-item">
                                <a class="page-link" href="{{ route($actions . '.show_rows', ['param' => $rowsList[0] + 1]) }}">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
            <div class="col-sm-4 col-md-4"></div>
        </div>

    </div>
@endsection