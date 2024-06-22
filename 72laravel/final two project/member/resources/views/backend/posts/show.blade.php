@extends('layout.master')
@section('title',"Each Post")
@section('content')
    <div class="container col-md-8 col-md-offset-2 mt-5">
        <div class="card">
            <div class="card-header justify-content-between bg-primary text-white">
                   {{$post->title}} by
                    {{$post->user->name}}
            </div>
            <div class="card-block">
                    {{$post->content}}
            </div>

        </div>
        <div class="card">
            @foreach($post->comment as $comment)
                <p class="alert alert-danger">{{$comment->content}}</p>
                @endforeach
        </div>
        <div class="card">
            <div class="card-body">
                @foreach($errors->all() as $error)
                    <p class="alert alert-warning">{{$error}}</p>
                    @endforeach
                @if(session('status'))
                    <p class="alert alert-success">
                        {{session('status')}}
                    </p>
                    @endif
                        <form action="{{url("/comment/create")}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="commendable_id" value="{{$post->id}}">
                        <input type="hidden" name="commendable_type" value="App\Post">
                        <div class="form-group">
                            <label for="comment">Insert Your Message</label>
                            <textarea id="comment" class="form-control" name="comments"></textarea>
                        </div>
                        <input type="submit" value="Comment" class="btn btn-primary">
                    </form>
            </div>

        </div>
    </div>
    @endsection