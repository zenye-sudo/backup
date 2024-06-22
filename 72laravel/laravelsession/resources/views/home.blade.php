<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@if(session('status'))
    {{session('status')}}<br>
    @endif
<a href="{{url('/putSession')}}"><button>Set Single Session</button></a>
<a href="{{url('/allSession')}}"><button>All Session</button></a>
<a href="{{url('/getSession')}}"><button>Get Session</button></a>
<a href="{{url('/deleteSession')}}"><button>Delete session</button></a>
<a href="{{url('/multipleSet')}}"><button>MultipleSet</button></a>
</body>
</html>