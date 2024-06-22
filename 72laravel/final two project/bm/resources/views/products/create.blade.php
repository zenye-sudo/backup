@extends('template.master')
@section('title','ProductCreate')
@section('content')
    <div class="container col-md-8 col-md-offset-2 bg-dark mt-4 p-4">
        <form action="" method="POST" enctype="multipart/form-data">
            <legend>Insert a new Product</legend>
            {{csrf_field()}}
            @foreach($errors->all() as $item)
                <div class="alert alert-danger">{{$item}}</div>
                @endforeach
            @if(session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
                @endif
            <div class="form-group">
                <lable for="title">Title</lable>
                <input type="text" id="title" class="form-control" name="title" placeholder="Title">
            </div>
            <div class="form-group">
                <lable for="description">Description</lable>
                <input type="text" id="description" class="form-control" name="description" placeholder="Description">
            </div>
            <div class="form-group">
                <lable for="writer">Writer</lable>
                <input type="text" id="writer" class="form-control" name="writer" placeholder="Writer">
            </div>
            <div class="form-group">
                <lable for="price">Prices</lable>
                <input type="number" id="price" class="form-control" name="price" placeholder="Price">
            </div>
            <div class="form-group">
                <lable for="image">Image</lable>
                <input type="file" id="file" class="form-control" name="file[]" placeholder="File" multiple>
            </div>
            <input type="submit" class="btn btn-info" name="submit" value="Submit">
        </form>
    </div>
    @endsection