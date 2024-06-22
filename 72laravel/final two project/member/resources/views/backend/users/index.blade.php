@extends('layout.master')
@section('title','Users')
@section('content')
    <div class="container mt-4 col-md-8 col-md-offset-2">
        <table class="table table-bordered">
            <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{action('admin\UsersController@edit',$user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection