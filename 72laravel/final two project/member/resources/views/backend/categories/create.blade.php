@extends('layout.master')
@section('title',"Add Category")
@section('content')
    <div class="container col-md-6 col-offset-md-3 mt-5">
        <form action="" method="post">
            <legend style="border-bottom:1px solid black;padding-bottom:14px;">Add a Category</legend>
            {{csrf_field()}}
            @foreach($errors->all() as  $error)
                <p class="alert alert-warning">{{$error}}</p>
                @endforeach
            @if(session("status"))
                <p class="alert alert-success">{{session('status')}}</p>
                @endif
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <input type="submit" class="btn btn-primary" value="Add Category">
        </form>
    </div>
    @endsection