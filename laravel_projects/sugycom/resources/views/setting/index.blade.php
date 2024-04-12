@extends('layouts.own.app')
@section('content')
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <div class="content">

        {{-- @if ($param !== null)
            @foreach ($param as $item)
                <p>{{ $item }}</p>
            @endforeach
        @endif --}}

        <form method="POST" action="{{ route($views_category . '.update') }}">
            @csrf

            <div class='row'>
                <div class="col-sm-3 col-md-3">
                    
                    <button type="submit" class="btn btn-success m-1 pl-4 sticky-top">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"/>
                        </svg>
                        Save
                    </button>
                
                </div>

                <div class="col-sm-9 col-md-9">
                    
                    <table class="table table-sm table-dark table-hover mt-2">

                        <body>

                            <tr>
                                <td><b>Database Status</b></td>
                                <td>
                                    <select name="database_status__" class="form-control">
                                        <option value="True" {{ $database_status == 'True' ? 'selected' : '' }}>True</option>
                                        <option value="False" {{ $database_status == 'False' ? 'selected' : '' }}>False</option>
                                    </select>
                                </td>
                            </tr>

                            <tr><td></td><td></td></tr>

                            <tr>
                                <td><b>Directories</b></td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#directories" aria-controls="directories">+</button>
                                </td>
                            </tr>

                            <div class="offcanvas offcanvas-top" tabindex="-1" id="directories" aria-labelledby="directoriesLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="directoriesLabel">Offcanvas top</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">                            

                                    <input type="text" name="input_directories" class="form-control">
                                    <button type="submit" class="btn btn-success mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"/>
                                    </svg>
                                    Save
                                    </button>
                                    
                                    <script>
                                    function sendData() {
                                        const inputValue = document.querySelector('input[name="input_directories"]').value;
                                        const route = "{{ route($views_category . '.store') }}"; // Aquí usas la ruta '.store'
                                        const urlParams = new URLSearchParams(window.location.search);
                                        urlParams.set('input_directories', inputValue);
                                        window.location.href = route + '?' + urlParams.toString();
                                    }
                                    </script>
                                                                      
                                </div>

                            </div>

                            @forelse ($dir as $item)
                                <tr>
                                    <td><input type="text" name="{{ "dir__" . str_replace("/", "_", str_replace(" ", "_", $item)) }}" class="form-control" value="{{ $item }}"></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td>No data.</td>
                                    <td></td>
                                </tr>
                            @endforelse

                            <tr><td></td><td></td></tr>

                            <tr>
                                <td><b>Py Setting</b></td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">+</button>
                                </td>
                            </tr>
                            @forelse ($py_settings as $item)
                                <tr>
                                    <td><input type="text" name="{{ "py_settings__" . str_replace("/", "_", str_replace(" ", "_", $item)) }}" class="form-control" value="{{ $item }}"></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No data.</td>
                                    <td></td>
                                </tr>
                            @endforelse

                            <tr><td></td><td></td></tr>

                            <tr>
                                <td><b>Py Scripts</b></td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">+</button>
                                </td>
                            </tr>
                            @forelse ($py_scripts as $item)
                                <tr>
                                    <td><input type="text" name="{{ "py_scripts__" . str_replace("/", "_", str_replace(" ", "_", $item)) }}" class="form-control" value="{{ $item }}"></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No data.</td>
                                    <td></td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>

                </div>

            </form>

        </div>
    </div>
@endsection