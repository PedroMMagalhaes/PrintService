<?php


//rota raiz
Route::get('/', 'PostsController@index')->name('home');

//rota login
//Route::get('/login', 'PostsController@login');


//rota detalhes
Route::get('/list/{id}', 'RequestsController@show')->name('printrequests.show');

//rota impressoes
Route::get('/list','RequestsController@list');



//rota login
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionsController@store');
//Route::get('/home', 'HomeController@index');
