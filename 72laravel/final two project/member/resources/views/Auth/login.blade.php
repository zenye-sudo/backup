@extends('layout.master')
@section('title','Login')
@section('content')
    <div class="container  col-md-8 col-offset-md-2 mt-5">
        <div class="well">
       <form method="post">
           <legend>Coder Login</legend>
           @foreach($errors->all() as $error)
               <p class="alert alert-warning">{{$error}}</p>
               @endforeach
           <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>
    </div>
@endsection