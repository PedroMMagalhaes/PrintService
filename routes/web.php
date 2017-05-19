<?php


//rota raiz
Route::get('/', 'PostsController@index')->name('home');


//rota detalhes
Route::get('/list/{id}', 'PrintRequestsController@show')->name('printrequests.show');

//rota impressoes
Route::get('/list','PrintRequestsController@list')->name('list');

//rota criar request
Route::post('/create','PrintRequestsController@create')->name('create');


//rota login
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login','SessionsController@store');

Route::get('/logout', 'SessionsController@destroy');
//Route::get('/home', 'HomeController@index');

Route::get('/profile', 'SessionsController@profile')->name('profile');
Route::post('/profile', 'SessionsController@update_avatar')->name('update_avatar');


Route::get('/list/{id}/download', 'PrintRequestsController@download')->name('printrequests.download');

Route::get('/list/{id}/complete', 'PrintRequestsController@setComplete')->name('printrequests.complete');
