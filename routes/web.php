<?php
use Hamcrest\Core\IsSame;

//rota raiz
Route::get('/', 'PostsController@index');

//rota login
Route::get('/login', 'PostsController@login');

//rota auth
Auth::routes();

//rota detalhes
Route::get('/list/{id}', 'PrintRequestsController@show')->name('printrequests.show');

//rota impressoes
Route::get('/list');

//->middleware('auth');
//Auth::routes();

//rota login
Route::get('/register', 'RegistrationController@create' );
Route::get('/login', 'SessionController@create');

Route::get('/home', 'HomeController@index')->name('home');
