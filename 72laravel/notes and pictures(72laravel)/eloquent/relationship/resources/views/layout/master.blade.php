<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tilte')</title>
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('font/fontawesome-free-5.0.11/web-fonts-with-css/css/fontawesome-all.css') !!}">
</head>
<body>
@include("sharedata.navbar")
@yield('content')
<script src="{!! asset("js/jquery-3.3.1.min.js") !!}"></script>
</body>
</html>