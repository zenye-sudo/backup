@extends('layout.master')
@section('title',"Edit Post")
@section('content')
    <div class="container col-md-6 col-offset-md-3 mt-3">
        <div class="well">
            <form action="" method="post">
                <legend style="border-bottom:1px solid black;">Insert A Post</legend>
                @foreach($errors->all() as $error)
                    <p class="alert alert-warning">{{$error}}</p>
                @endforeach
                @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="user_id" value="{{$post->user_id}}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label for="cat_id">Choose Category</label>
                    <select name="cat_id" id="" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                            @if($post->cat_id==$category->id)
                                selected="selected"
                                @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$post->content}}</textarea>
                </div>
                <input type="submit" value="Post" class="btn btn-primary float-right">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    @endsection