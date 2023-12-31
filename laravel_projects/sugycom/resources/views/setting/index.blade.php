@extends('layouts.own.app')
@section('content')
    <div class="content">

        <div class="col-sm-12 col-md-12">
            
            <table class="table table-sm table-dark table-hover">
                <thead>
                    <tr><th>Database Status:</th>
                        <th>
                            <select name="database_status" class="form-control">
                                <option value="VRSS-1" {{ $database_status == 'True' ? 'selected' : '' }}>True</option>
                                <option value="VRSS-2" {{ $database_status == 'False' ? 'selected' : '' }}>False</option>
                            </select>
                        </th>
                    </tr>
                </thead>
            </table>

            <table class="table table-sm table-dark table-hover">
                <thead>
                    <tr>
                        <th>Directory:</th>
                        <th>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">+</button>
                        </th>
                    </tr>
                    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasTopLabel">Offcanvas top</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <input type="text" name="" class="form-control">
                        </div>
                        <button type="button" class="btn btn-outline-success mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"/>
                            </svg>
                        </button>
                    </div>
                </thead>
                <tbody>
                    @forelse ($dir as $item)
                        <tr>
                            <td><input type="text" name="" class="form-control" value="{{ $item }}"></td>
                            <td>
                                <button type="button" class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-outline-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td>No data.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <table class="table table-sm table-dark table-hover">
                <thead>
                    <tr>
                        <th>Py Setting:</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($py_settings as $item)
                        <tr>
                            <td><input type="text" name="" class="form-control" value="{{ $item }}"></td>
                        </tr>
                    @empty
                        <tr><td>No data.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <table class="table table-sm table-dark table-hover">
                <thead>
                    <tr><th>Py Scripts:</th></tr>
                </thead>
                <tbody>
                    @forelse ($py_scripts as $item)
                        <tr><td><input type="text" name="" class="form-control" value="{{ $item }}"></td></tr>
                    @empty
                        <tr><td>No data.</td></tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection