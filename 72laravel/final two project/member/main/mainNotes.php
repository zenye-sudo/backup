<?php
******************************Usage of Float right start****************************
      <input type="submit" class="btn btn-info float-right" name="submit" value="Submit">
      <div class="clearfix"></div>
******************************Usage of Float right start****************************
***********************************Usage of csrf_token*****************************
      <input type="hidden" name="_token" value="{{csrf_token()}}">
***********************************Usage of csrf_token*****************************
--IN the previous project('ZenShop'),We made own request file with request.In this project,we will use framework Auth file in the controller directory.
  In web.php=>Route::get('/users/register','Auth\RegisterController@show');//own wirte=>return view('register')
              Route::post('/users/register','Auth\RegisterController@register');//No write=:>auto register and auto save in database
              Route::get('/users/logout','Auth\LoginController@logout');//Same too
              Route::get('/users/login','Auth\LoginController@show');//own write=>return view('login')
              Route::post('/users/login','Auth\LoginController@login');//No writer=>auto check and login
  **Checking login lote pyi.ma pyi
                    @if(Auth::check())
                        <a class="dropdown-item" href="#">Logout</a>
                    @else
                        <a class="dropdown-item" href="#">Login</a>
                        <a class="dropdown-item" href="{{url('/users/register')}}">Register</a>
                        @endif
  **Checking login lote pyi.ma pyi
  **To make Admin Panel,You must make route::group(array('prefix'=>'admin','namespace'=>'admin','middleware'=>'auth'),function(){
                    Route::get('users','UserController@index')//Create controller in admin\userController because of namespace is 'admin'
                    });
********************************************middleware************************************
  To create middle,use this command "php artisan make:middleware middlewareName";
  And you must advertise in the Kernal file=>
                                            middlewareGroup=>For all Route inside web.php
                                            middle=>For all Route
                                            routeMiddleware => For certain Route Group
  ****permission package****
  -To create permission package,You has to make require laravel-permision in composer.It is "composer require spatie/laravel-permision";
    and you has to advertise in the "config/app.php=>provider array" that is  "Spatie\Permission\PermissionServiceProvider::class,";
    and public migration that is command "php artisan vendor:publish='Spatie\Permission\PermissionServiceProvider' --tag='migrations'";
    and public laravel-permision config file that is command "php artisan vendor:publish='Spatie\Permission\PermissionServiceProvider' --tag='config'"
   -Checking Rank Status 
       public function edit($id){
        $user=User::whereId($id)->firstOrFail();
        $roles=Role::all();
        $rolesSelected=$user->roles()->pluck('name')->toArray();//Has Many Relationship(framework)
        return view('backend.users.edit',compact("user","roles","rolesSelected"));
        }
    -sync(auto add or remoev)
        public function update(Request $request,$id){
        $user=User::whereId($id)->firstOrFail();
        $user->syncRoles($request->get('roles'));//Has Many Relationship(framework)
        return redirect(action('admin\UsersController@edit',$id))->with('status',"Update successful");
        }
    -Using Manager middleware("check manger(admin)")
       if(!Auth::check()){
           return redirect('/users/login');
       }else{
           if(Auth::user()->hasRole('Manager')){
               return $next($request);
           }else{
              return redirect('/');
           }
       }
    --FOr category_name update
        public function update(Request $request, $id)
        {
        $categoryname=Category::whereId($id)->firstOrFail();
        $categoryname->name=$request->get('name');
        $categoryname->update();
        return redirect(action('admin\CategoriesController@edit',$id))->with('status',"Successfully Edited Category.");
        }
    --Getting Current User
        public function create()
        {
        $categories=Category::all();
        $user=Auth::user();
        return view('backend.posts.create',compact("categories","user"));
        }
********************************************middleware************************************

********************************************Main Notes from final project(re-make)****************************
===>In this membersystem project,We will use built-in controller for login and register.For Logout feature,You will use loginController.
===>To create laravel permission package(for advertise rank) "Loot at picture";And you don't need create role table and package will create table.and if you use itYou can use "Use Spatie/Permission/Models/Role".To Use Many To Many relationship.You can use This command "use HasRoles" in the class of (_) table.
===>Note=>controller name ko s hte pay ya tal.