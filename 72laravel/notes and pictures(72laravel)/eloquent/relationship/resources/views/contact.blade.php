@extends("layout.master")
@section("title","contact")
@section("content")
    <div class="container">
        <h1>I am a contact page.</h1>
    </div>
    <ul>
        @if(count($array)>0)
    @foreach($array as $ary)
        <li>{{$ary}}</li>
    @endforeach
            @endif
    </ul>
    @endsection