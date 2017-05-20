<?php


//rota raiz
Route::get('/', 'InicialController@index')->name('home');


//rota detalhes
Route::get('/list/{id}', 'PrintRequestsController@show')->name('printrequests.show');

//rota impressoes
Route::get('/list','PrintRequestsController@list')->name('list');

//rota criar request
Route::post('/create','PrintRequestsController@create')->name('create');


//rota users
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'UserController@login_get');
Route::post('/login','UserController@login_post');

Route::get('/logout', 'UserController@logout')->name('logout');;
//Route::get('/home', 'HomeController@index');

Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/profile', 'UserController@update_avatar')->name('update_avatar');
Route::post('/profile', 'UserController@update_profile')->name('update_profile');


Route::get('/list/{id}/download', 'PrintRequestsController@download')->name('printrequests.download');

Route::get('/list/{id}/complete', 'PrintRequestsController@setComplete')->name('printrequests.complete');
