@extends("layout.master")
@section('title',"All Categories")
@section('content')
       <div class="container col-md-6 col-offset-md-3 mt-5">
           <table class="table table-bordered">
               <thead>
               <th>Id</th>
               <th>Name</th>
               <th>Generate</th>
               </thead>
               <tbody>
               @foreach($categories as $category)
                   <tr>
                       <td>{{$category->id}}</td>
                       <td>{{$category->name}}</td>
                       <td><a href="{{action('admin\CategoriesController@edit',$category->id)}}">Edit</a></td>
                   </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
    @endsection