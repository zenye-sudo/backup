@extends('layout.master')
@section('title',"View Post")
@section('content')
    <div class="container col-md-6 col-offset-md-3 mt-5">
        <div class="well">
            <table class="table table-bordered">
                <thead>
                <th>Id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Generate</th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                        <td>{{$post->id}}</td>
                        <td><a href="{{action("postsCreator\PostsController@show",$post->id)}}">{{$post->title}}</a></td>
                        <td>{{$post->content}}</td>
                        <td><a href="{{action("postsCreator\PostsController@edit",$post->id)}}">edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection