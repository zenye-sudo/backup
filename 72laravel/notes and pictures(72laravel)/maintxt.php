<?php
*********************************************************Notes start*************************************************
--index.page is equal in "/" in route class get method.eg=Route::get("query",closure)
--If you want to connect css and js you can use "asset("css/---")"
--Blade template engine is accept to php varible by {{}} in;
--Using Blade template engine
  In matser.blade.php =>@yield("title") and @yield("content");
  In index.blade.php  =>@extends("layout.master")
                        @section("title","leepae")
                        @section("content")
                        @endsection
--If you want to loop array
  -In web.php =>Route::get("/contact","PostsController@contact");
   In PostsController=>public function contact(){
                       $array=["zenye","yezen","aungaung","maungmaung"];
                       return view("contact",compact("array"));
                       }
    In view=><ul>
            @if(count($array)>0)
           @foreach($array as $ary)
           <li>{{$ary}}</li>
           @endforeach
            @endif
           </ul>
           @endsection

--If you want to include file blade template system "@include('main.index')";
--you can use it If you want to go url =>url("/chats/zenye");
--If you wnat to hashing password ,You can use Hash::make("password");
**************************************************************Notes end********************************************************
***************************************************************Section1 start*****************************************************
************************************Route Class Start********************************************
    Route::get("query",clouse);
Eg->Route:get("/",function(){
    echo "This is index page;";
    });
Eg2->Route:get("/login",funcion(){
	echo "This is login page.";
});

--Url->index.php/posts/20/title
    Eg-3->Route:get("/posts/{pid}/{title}",function($pid,$title){
	echo "The post id is".$pid." and post title is ". $title;
    });
--URL shortener-->format->Route::get("query string",array("as"=>"dd",clsoure(){}));
    Route::get("/posts/id/pp/url/sdf",array("as"=>"short.php",functoin(){
	$url=route("short.php");
	return "his url is".$url;
    }));
    It you want to look log of this.You can check in cmd "php artisan route:list";
--Create controller and usage of static get method of route class.
  method1->php artisan make:controller postController.php
  method2->php artisan make:controller --resource postsController.php
--Usage of controller class in route class
  Eg->Route::get("/","className@method");
  It you want to passing through parameter.You can do.
  -Route::get("/{username}/{password}",postsController@index);
  In index method on postsController ->
  public function index($username,$password){
  echo "Your name ".$username." and your password is ".$password; 
  }
--Route::resource saved default method of a class.
  Eg->Route::resource("/posts","PostsController");save and open "php artisan route:list";
--Create view and usage
  In web.php=>Route::get("/contact",postsController@contact);
              Route::get("/about",postsController@about);
              Route::get("/chat",postsController@chat);
  In postsController Class=>public function contact(){
                            return view("contact");
                            }//thone kar yae par
  In View=>create threee view
          1.contact,2.about,3.chat
--Passing Data view array by with(array("key"=>"value"));
  In web.php=>Route::get("/chat/{username}/{password}",postsController@chat);
  In postsController Class=>public function chat($username,$password){
                            return view("chat")->with(array("username"=>$username,"password"=>$password));
                            }
  In View=>username is {{$username}} and password is {{$password}};
--Passing Data view array by conpact('username','password');//not contain dollar sign.
  In web.php=>Route::get("/chat/{username}/{password}",postsController@chat);
  In postsController Class=>public function chat($username,$password){
                            return view("chat",compact("username","password"))
                            }
  In View=>username is {{$username}} and password is {{$password}};

*****************************************************Route Class Start*******************;
*****************************************************Section1 End*****************************************************************


*****************************************************Section 2(databasing) start**************************************************
---If you want to migrate migration file.you can use "php artisan migrate" keywords in terminal.and want to reset,you can use "php artisan migrate:rollback "(or) php artisan migrate:reset 
   and useful keywords are 
   1.php artisan migrate:status
   2.php artisan migrate:refresh

--If you want to create migration file .YOu must use "php artisan make:migration filename --create=table name"; 
  -If text,text("content"),
   IF varchar,string("context"),
   If auto_i,increments("id"),
   If integer,tinyInteger("is_admin")->default('0');

--If you want to add one column to already exits table.You must use "php artisan make:migration filename --table=table name";
  -integer,tinyInteger("is_admin")->default('0');
  If you want to drop column.You must uses "$table->dropColumn('column_name')" in migration file;

Note--There are three method of database laravel.
******************1. RawSql method*******************************
--If you want to insert datas to database Here is the method.
  Route::get('/insert',function(){
  DB::insert("insert into table(id,name) value(?,?)",[1,"zneye"]);
  })
--If you want to retrieve datas from database
  Route:get("/select",function(){
   $result=DB::select("select * from posts from id=?",[1]);
   foreach($result as $item){
    return $item->title;
   }
  });
  $result1=DB::select("select * from posts");
  $str="";
  foreach($result1 as $item){
    $str.=$item->title;
  }
  return $str;

--If you want to update datas from database
  Route::get('/update',function(){
  $result=DB::update("update posts set title=? where id=?",["hello",1]);
  echo $result;if(true)==1 or not 0;
  });
--If you want to delete datas
  Route::get("/delete/{id}",function($id){
  $result=DB::delete("delect from posts where id=?",[$id]);
  echo $result;
  });
******************1. RawSql method END*******************************
*******************2.Model start***********************************
Note :: model work database update,insert,delete,select,update.
---If you want to create model .You must use "php artisan make:model modelname -m" method.=>m is the migration
   IF your table name is different to model=>You can use "protected $table='tablename'" in Model.
   If you want to change key=>You can use "protectd primaryKey='column name'";
---Model usage1(all())
   In web.php=>use App\post;
               Route::get("/getall",function(){
               $result=Post::all();
               foreach($result as $item){
                echo $item->title."<br>";
               }
               echo $result;
               });
   In model(post.php)=>namespace App;
                       use Illuminate\Database\Eloquent\Model;
                       class post extends Model{}

--Model usage2(find(),where(),get(),take())
  in web.php=>use App\post;
              Route::get("/get",function(){
                  echo post::find(1);//Values that is id =1 is executed.
                  echo post::where("id",1)->where("is_admin",1)->get();//Values that is id=1 and is_admin=1
                  echo post::where('is_admin',1)->take(1)->get();//Values that is is_admin=1 and limite1 get
              });
  In model(post.php)=> In model(post.php)=>namespace App;
                       use Illuminate\Database\Eloquent\Model;
                       class post extends Model{}
--Model usage3(insert method)
   In web.php=>use App\Post;
               Route::get('/insert',function(){
               post::create(["title"=>"add1","content"=>"add1"]);
               });
   In model(post.php)=>namespace App;
                       use Illuminate\Database\Eloquent\Model;
                       class post extends Model
                       {
                         protected $filable=['title','content'];
                      }
---Model usage4(update method)
   In web.php=>use App\post;
               Route::get('/update',function(){
               post::where('id',1)->where('is_admin',1)->update(['title'=>'leepase','content'=>'content']);
               });
   In model(post.php)=>In model(post.php)=>namespace App;
                       use Illuminate\Database\Eloquent\Model;
                       class post extends Model{}

---Model usage5(delete and destory)
   In web.php=>use App/post;
               Route::get('/delete',function(){
               //delete method
                $post=post::search(1);
                $post->delete();
                //destroy method
                post::destroy();
               })
   In model(post.php)=>In model(post.php)=>namespace App;
                      use Illuminate\Database\Eloquent\Model;
                      class post extends Model{}

---Model usage6(Createing softDelete);
   In Model(post.php)=> namespace App;
                       use Illuminate\Database\Eloquent\Model;
                       use Illuminate\Database\Eloquent\SoftDeletes;
                       class post extends Model
                       {
                           use SoftDeletes;
                           protected $dates=['deleted_at'];
                           protected $fillable=['title','content'];
                       }
   In web.php=>
               use App\post;
               Route::get("/softDelete",function(){
                  $post=Post::find(4);
                  $post->delete();
               });

---Model usage7(retrieve trashed datas and restore and forcedDelete)
   className::find(id number)=>Not trashed datas
   className::withTrashed()->get()=>not trashed and trashed datas
   className::onlyTrashed()->get()=>only trashed datas;
   className::onlyTrashed()-where(id)->restore();
   className::onlyTrashed()-where(id)->forcedDelete();

---Model usage7(insert and update)(a thone ma myar);
   in web.php=>use App\post;
               Route::get('/insert',function(){
               //This is model insert method start
               $post=new post();
               $post->title="Hello1";
               $post->content="hello2";
               $post->save();
               //This is model insert method end
               //This is model update start
               $find=post::find(1);
               $find->title="Change 1";
               $find->content="Change 2";
               $find->save();
               //This is model update end
               });
   In model(post.php)=> In model(post.php)=>namespace App;
                       use Illuminate\Database\Eloquent\Model;
                       class post extends Model{}
********************2.Model end***********************************
*********************3.Eloquent relationship start**********************
-----one to one Eloquent method start
     In web.php=>use App\article;
                 Route::get("/posts/insert",function(){
                 article::create(['user_id'=>2,'title'=>"Post Title 2",'content'=>'Post Content 2']);
                 });
                 Route::get('posts',function(){
                    $posts=article::all();
                    foreach($posts as $post){
                        echo $post->title."<br>".$post->content."<br>".$post->user->name."<hr>";
                    }
                 });
     In article.php=>namespace App;
                     use Illuminate\Database\Eloquent\Model;
                     class article extends Model
                     {
                       protected $fillable=['user_id','title','content'];
                       public function user(){
                           return $this->belongsTo('App\User');
                       }
                     }
-----one to one Eloquent method end
-----hasOne eloqunt method start
     ---In web.php=>Route::get("/test/{id}",function($id){
                    $user=User::where('id',$id)->firstOrFail();
                    echo $user->city->name;
    ----In user.php=>public function city(){
                    return $this->hasOne('App\City');
                     }
});
-----hasOne eloquent method end
-----hasMany(one to many) Eloquent method Start***************************************************
     In web.php=>use App\User;
                 Route::get("/user/{id}/show",function($id){
                 $user=User::where('id',$id)->firstOrFail();
                 foreach($user->posts as $item){
                   echo $item['title']."<br>";
                  }
                  });
     In User.php=>public function posts(){
                  return $this->hasMany('App\article');
                  }
-----hasMany(one to many) Eloquent method End****************************************************
Note=>If you use where,you must use firstOrFail() or first();
     Ex=>$user=User::where('id',$id)->firstOrFail();
-----Many to Many--------------------------------------
   In web.php=>use App\User;
               Route::get('/{id}/rank',function($id){
               $user=User::find($id);
               echo $user->name."<br>";
               foreach($user->rank as $item){
                   echo "Job is ".$item->rank;
               }
               });
    In users.php=>namespace App;
                 public function rank(){
                 return $this->belongsToMany('App\role');
                  }
------Many to many----------------------------------
-------Has many through**************************
  First=>city id pay tar nae "in the city posts" executesd;
  In web.php=>use App\User;
             Route::get('/city/{id}',function($id){
              $city=City::find($id);
              foreach($city->posts as $item){
                  echo $item->title;
              }
           });
  IN City.php=>namespace App;
               public function posts(){
                 return $this->hasManyThrough('App\article','App\User','city_id','user_id');
              }
-------Has many through*************************
----------------------------------------------Polymorphis relation start*****************
       In web.php=>Route::get('/user/{id}/comments',function($id){
                      $user=User::find($id);
                      echo $user->name."<br>";
                      foreach($user->comments as $item){
                          echo $item['content'];
                      }
                  });
                  });
       In Comments model=>polymorphis ko thone mar phit kyne kyaw nyar
                             public function commendable(){
                             return $this->morphTo();
                             }
       In users model=>namespace App;
                       public function comments(){
                       return $this->morphMany('App\Comments','Commendable');
                       }
       In article model=>namespace App;
                         public function comments(){
                         return $this->morphMany('App\Comments','Commendable');
                         }
------------------------------------------------------Polymorphis relation end*****************
*********************3.Eloquent relationship end**********************
*****************************************************Section 2(databasing) End****************************************************
**************Section 3[Two pratical project is support ticket system and blog system(not contain in this video series)];*********


**************************Eloquent Notes start***************************
**Main Page ka nay ko lo chin tae a check ko yae ya tal.
One to one(belongsTo) 
hasone(hasone)
hasMany(hasMany)
ManyToMany(belongsToMany)
hasManyThrough(hasManyThrough("want value","pass table","first_id","last_id");)
Polymorphis(in the main comments model=morphTo('commendable') and other is=morphMany('tablename',"methd"))
**************************Eloquent Notes end***************************
