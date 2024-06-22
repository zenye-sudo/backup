<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users/register','Auth\RegisterController@show');
Route::post('/users/register','Auth\RegisterController@register');
Route::get('/users/logout','Auth\LoginController@logout');
Route::get('/users/login','Auth\LoginController@show');
Route::post('/users/login','Auth\LoginController@login');

Route::group(array("middleware"=>'auth'),function(){
    Route::post('/comment/create',"CommentsController@store");
});
Route::group(array('prefix'=>'postsCreator','namespace'=>'postsCreator','middleware'=>'PostsWare'),function(){
    Route::get('posts',"PostsController@index");
    Route::get('posts/create',"PostsController@create");
    Route::post('posts/create',"PostsController@store");
    Route::get('/posts/{id}/edit',"PostsController@edit");
    Route::post('/posts/{id}/edit',"PostsController@edit1");
    Route::get('/posts/{id}/show',"PostsController@show");
});
Route::group(array('prefix'=>'admin','namespace'=>'admin','middleware'=>'Manager'),function(){
    Route::get('/',"AdminController@index");
   Route::get('users','UsersController@index');
   Route::get('users/{id}/edit','UsersController@edit');
   Route::post('users/{id}/edit',"UsersController@update");

   Route::get('roles',"RolesController@index");
   Route::get("roles/create","RolesController@create");
   Route::post('roles/create','RolesController@store');

   Route::get('categories',"CategoriesController@index");
   Route::get('categories/create','CategoriesController@create');
   Route::post('categories/create',"CategoriesController@store");
   Route::get('categories/{id}/edit',"CategoriesController@edit");
   Route::post('categories/{id}/edit',"CategoriesController@update");
});