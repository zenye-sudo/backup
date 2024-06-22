@extends('layout.master')
@section('title','Edit Category')
@section('content')
    <div class="container col-md-6 col-offset-md-3 mt-5">
        <form action="" method="post">
            <legend style="border-bottom:1px solid black;padding-bottom:10px;">Edit Category</legend>
            {{csrf_field()}}
            @if(session('status'))
                <p class="alert alert-success">{{session('status')}}</p>
                @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{$categoryName->name}}">
            </div>
            <input type="submit" class="btn btn-primary" value="Edit">
        </form>
    </div>
    @endsection