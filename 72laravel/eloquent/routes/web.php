<?php
use App\ThoneThu;
use App\Post;
use App\City;
Route::get('/insertUser/{name}/{email}',function($name,$email){
   $user=ThoneThu::create(['name'=>$name,'email'=>$email,'password'=>Hash::make($email)]);
   echo $user;
});
Route::get('/posts/{id}',function($id){
   $post=Post::find($id);
   echo $post->title."<br>";
   foreach($post->Posts as $item){
       echo $item;
   }
});
Route::get('/city/{id}',function($id){
    $city=City::find($id);
    foreach($city->Posts  as $item){
        echo $item['title'];
    }
});
Route::get('/users/{id}',function($id){
   $user=ThoneThu::find($id);
   echo $user->name;
   foreach($user->ranks as $item){
       echo $item['rank'];
   };
});
Route::get('/user/{id}',function($id){
   $user=ThoneThu::find($id);
   echo $user->name;
   foreach($user->Posts as $item){
       echo $item['title'];
   }
});