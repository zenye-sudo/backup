@extends('layout.master')
@section('title',"Role Insert")
@section('content')
    <div class="container mt-5 col-md-6 col-offset-md-3 ">
        <form action="" method="post">
         <legend>Add a role</legend>
            {{csrf_field()}}
            @foreach($errors->all() as $error)
                <p class="alert alert-warning">{{$error}}</p>
                @endforeach
            @if(session('status'))
                <p class="alert alert-success">{{session('status')}}</p>
                @endif
         <div class="form-group">
             <input type="text" class="form-control" name="name" placeholder="role">
         </div>
         <input type="submit" value="insert" class="btn btn-primary">
        </form>
    </div>
    @endsection