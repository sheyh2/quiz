<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css?v=' . app()->version()) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css?v=' . app()->version()) }}">

    @stack('my-css')

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>

    @stack('my-js')
</head>
<body>

@yield('content')

</body>
</html>
