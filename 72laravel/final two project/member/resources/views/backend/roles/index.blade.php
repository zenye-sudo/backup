@extends("layout.master")
@section('title','View All Role')
@section('content')
    <div class="container mt-5 col-md-6 col-md-offset-3">
        <table class="table table-bordered">
            <thead>
            <th>Id</th>
            <th>Name</th>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection