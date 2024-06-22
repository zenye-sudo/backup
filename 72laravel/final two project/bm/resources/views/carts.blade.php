@extends('template.master')
@section('title','Home')
@section('content')
   <div class="container-fluid mt-4">
       <div class="row">
           <div class="col-md-3 mb-3">
               {{--Sidebar start--}}
               <div class="accordion" id="parent">
                   <div class="card bg-dark">
                       <div class="card-header">
                           <a href="#" class="btn-link" style="color:white" data-toggle="collapse" data-target="#one">Account</a>
                       </div>
                       <div class="collapse show card-block" id="one" data-parent="#parent">
                           <ul>
                               <li style="margin-top:12px;list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Sales</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Customers</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Products</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Shopping Cart</a></li>
                           </ul>
                       </div>
                   </div>
                   <div class="card bg-dark" >
                       <div class="card-header">
                           <a href="#" style="color:white" class="btn-link" data-toggle="collapse" data-target="#two">Content</a>
                       </div>
                       <div class="collapse card-block" id="two" data-parent="#parent">
                           <ul>
                               <li style="margin-top:12px;list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Sales</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Customers</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Products</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Shopping Cart</a></li>
                           </ul>
                       </div>
                   </div>
                   <div class="card bg-dark" >
                       <div class="card-header">
                           <a href="#" class="btn-link" style="color:white;" data-toggle="collapse" data-target="#three">Modules</a>
                       </div>
                       <div class="collapse card-block" id="three" data-parent="#parent">
                           <ul>
                               <li style="margin-top:12px;list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Sales</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Customers</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Products</a></li>
                               <li style="list-style-type:none;border-bottom:1px solid white;padding-bottom:5px;"><a href="#" style="color:white;text-decoration:none;">Shopping Cart</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
               {{--Sidebar end--}}
           </div>
           <div class="col-md-9">
               {{--Content Start--}}
               <div class="container-fluid" style="color:black;">
                   <div class="row">
                       @foreach($products as $product)
                       <div class="col-md-4">
                           <div class="card">
                               <div class="card-header m-0 p-0">
                                   <h3 style="font-family:Cambria" class="text-center">{{$product->title}}</h3>
                                   <img src="{{asset('uploads/'.unserialize($product->imgs)[0])}}" style="width:100%" class="">
                                   <div class="row justify-content-between m-1 p-1">
                                       <span>{{$product->prices}}</span>
                                       <span>{{$product->writer}}</span>
                                   </div>
                               </div>
                               <div class="card-block">
                                   <p class="text-justify" style="text-indent: 34px;">{{$product->description}}</p>
                                   <div class="row justify-content-between m-1 p-1">
                                       <button class="btn btn-info">Details</button>
                                       <a href="{{action('PageController@add',$product->id)}}" class="btn btn-success">Buy</a>
                                   </div>
                               </div>
                           </div>
                       </div>
                       @endforeach
                   </div>
               </div>
               {{--Content End--}}
           </div>
       </div>
   </div>
   <script>
       var own=document.getElementsByClassName('own');
       var collapseDiv=document.getElementById('collapseDiv');
       var test=collapseDiv.children[0].children;
       var test1=collapseDiv.children[1].children;
       for(var i=0;i<own.length;i++){
           own[i].addEventListener('click',function(){
               for(var o=0;o<test.length;o++){
                   test[o].classList.remove('active');
               }
               for(var u=0;u<test1.length;u++){
                   test1[u].classList.remove('active');
               }
               this.classList.add('active');
           });
       }
   </script>
    @endsection