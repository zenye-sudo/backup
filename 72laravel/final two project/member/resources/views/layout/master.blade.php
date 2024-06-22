<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('bootstrap\css\bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap\fontawesome-free-5.0.11\fontawesome-free-5.0.11\web-fonts-with-css\css\fontawesome-all.css')}}">
</head>
<body>
@include('layout.navbar')
@yield('content')
<script src="{{asset('bootstrap/script/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('bootstrap/script/tether.js')}}"></script>
<script src="{{asset('bootstrap/script/bootstrap.min.js')}}"></script>
</body>
</html>