<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    @include('layouts._partials.navbarh')
    <div class="container">
        <div class="row">
            <div class="col-2">
                @include('layouts._partials.navbarv')
            </div>
            <div class="col-9">
                @yield('content')
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
</html>