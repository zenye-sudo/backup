@extends('layout.master')
@section('title',"Admin Control")
@section('content')
    <div class="container col-md-8 col-offset-md-2 mt-5">
        <div class="admin_panel">
            <div style="margin-bottom:34px;">
                <h4 style="border-bottom:1px solid black;padding-bottom:14px;">User</h4>
                <a href="{{url('/admin/users')}}"><button class="btn btn-primary">Edit Users</button></a>
                <a href="{{url('/admin/roles/create')}}"><button class="btn btn-primary">Add Rank</button></a>
            </div>
            <div style="margin-bottom:34px;">
                <h4 style="border-bottom:1px solid black;padding-bottom:14px;">Catagories</h4>
                <a href="{{url('/admin/categories')}}"><button class="btn btn-primary">View all catagories</button></a>
                <a href="{{url('/admin/categories/create')}}"><button class="btn btn-primary">Add Catagory</button></a>
            </div>
            <div style="margin-bottom:34px;">
                <h4 style="border-bottom:1px solid black;padding-bottom:14px;">Posts</h4>
                <a href="{{url('/postsCreator/posts')}}"><button class="btn btn-primary">View all posts</button></a>
                <a href="{{url('/postsCreator/posts/create')}}"><button class="btn btn-primary">Add Post</button></a>
            </div>
        </div>
    </div>
    @endsection