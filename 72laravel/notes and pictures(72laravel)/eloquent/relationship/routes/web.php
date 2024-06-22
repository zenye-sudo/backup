<?php
use App\article;
use App\User;
use App\City;
Route::get("/posts/insert",function(){
    article::create(['user_id'=>2,'title'=>"Post Title 2",'content'=>'Post Content 2']);
});
Route::get('posts',function(){
   $posts=article::all();
   foreach($posts as $post){
       echo $post->title."<br>".$post->content."<br>".$post->user->name."<hr>";
   }
});
Route::get("/user/{id}/show",function($id){
    $user=User::where('id',$id)->firstOrFail();
    foreach($user->posts as $item){
        echo $item['title']."<br>";
    }
});
Route::get("/test/{id}",function($id){
   $user=User::where('id',$id)->firstOrFail();
   echo $user->city->name;
});
Route::get('/{id}/rank',function($id){
    $user=User::find($id);
    echo $user->name."<br>";
    foreach($user->rank as $item){
        echo "Job is ".$item->rank;
    }
});
Route::get('/city/{id}',function($id){
   $city=City::find($id);
   foreach($city->posts as $item){
       echo $item->title;
   }
});
Route::get('/user/{id}/comments',function($id){
    $user=User::find($id);
    echo $user->name."<br>";
    foreach($user->comments as $item){
        echo $item['content'];
    }
});
Route::get('/article/{id}/comments',function($id){
    $article=article::find($id);
    echo $article->id."<br>";
    foreach($article->comments as $item){
        echo $item['content'];
    }
});