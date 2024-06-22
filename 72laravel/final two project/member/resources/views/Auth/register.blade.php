@extends('layout.master')
@section('title',"Register Page")
@section('content')
      <div class="container  col-md-8 col-offset-md-2 mt-5">
          <div class="well">
              <form action="" method="POST" enctype="multipart/form-data">
                  <legend>Coder Register</legend>
                  @foreach($errors->all() as $error)
                      <div class="alert alert-warning">{{$error}}</div>
                      @endforeach
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="form-group">
                      <lable for="username">Username</lable>
                      <input type="text" id="username" class="form-control" name="name" placeholder="username">
                  </div>
                  <div class="form-group">
                      <lable for="email">Email</lable>
                      <input type="text" id="email" class="form-control" name="email" placeholder="email">
                  </div>
                  <div class="form-group">
                      <lable for="password">Password</lable>
                      <input type="password" id="password" class="form-control" name="password">
                  </div>
                  <div class="form-group">
                      <lable for="comfirmPassword">Comfirm-Password</lable>
                      <input type="password" id="comfirmPassword" class="form-control" name="password_confirmation">
                  </div>
                  <input type="submit" class="btn btn-info float-right" name="submit" value="Submit">
                  <div class="clearfix"></div>
              </form>
          </div>
      </div>
    @endsection