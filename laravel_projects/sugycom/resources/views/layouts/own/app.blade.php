<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        .footer-panel {
            font-size: 0.7rem;
            margin-left: 3rem
        }

        .footer-panel li {
            list-style: none;
        }

        .footer-panel h3 {
            font-size: 0.8rem;
        }
        
        .footer-bottom {
            font-size: 0.7rem;
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 0.5rem;
        }

        .celdas {
            
        }
    </style>
</head>
<body>
    @include('layouts.own._partials.navbarh')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2">
                {{-- @include('layouts.own._partials.navbarv') --}}
            </div>
            <div class="col-sm-9 col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.own._partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>