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

Route::get('/','SessionController@index');
Route::get('/putSession','SessionController@putSession');
Route::get('/allSession','SessionController@allSession');
Route::get('/getSession','SessionController@getSession');
Route::get('/deleteSession','SessionController@deleteSession');
Route::get('/multipleSet',"SessionController@multipleSet");