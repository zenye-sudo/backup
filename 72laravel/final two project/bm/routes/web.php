<?php
Route::get('/','PageController@index');
Route::get('/products/create','ProductController@create');
Route::post('/products/create','ProductController@store');
Route::get('/products/buy/{id}','PageController@add');
Route::get('/carts/show','PageController@show');
