<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script src="{{ asset('assets/bootstrap-5.2.3/dist/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.2.3/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons-1.10.4/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    @if (Route::currentRouteName() != 'login')
        <style>
            body {
                background-image: url("/assets/image/bg3.jpg");
            }
        </style>
    @else
        <style>
            body {
                /* background: rgb(91, 192, 248);
                background: radial-gradient(circle, rgba(91, 192, 248, 1) 0%, rgba(0, 129, 201, 1) 100%); */

                /* background: rgb(91, 192, 248);
                background: linear-gradient(90deg, rgba(91, 192, 248, 1) 0%, rgba(0, 129, 201, 1) 100%); */

                background-image: url("/assets/image/bg2.jpg");
            }
        </style>
    @endif

    @auth
        @include('partials.navbar')
    @endauth
    <div class="container">
        @yield('content')
    </div>
    @include('sweetalert::alert')

</body>

</html>
