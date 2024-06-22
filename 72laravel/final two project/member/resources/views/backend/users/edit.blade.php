@extends('layout.master')
@section('title','Edit User')
@section('content')
    <div class="container mt-5 col-md-6 col-offset-md-3">
        <form action="" method="post">
            <legend>Edit User</legend>
            {{csrf_field()}}
            @if(session('status'))
                <p class="alert alert-success">{{session('status')}}</p>
                @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <lable for="roles">Select Rank</lable>
                <select name="roles[]" id="roles[]" class="form-control" multiple>
                    @foreach($roles as $role)
                    <option value="{{$role->name}}"
                          @if(in_array($role->name,$rolesSelected))
                              selected="selected"
                              @endif
                    >{{$role->name}}</option>
                        @endforeach
                </select>
            </div>
            <input type="submit" value="Edit" class="btn btn-primary">
        </form>
    </div>
    @endsection