<?php
use Hamcrest\Core\IsSame;

//rota raiz
Route::get('/', 'PostsController@index')->name('home');

//rota login
//Route::get('/login', 'PostsController@login');


//rota detalhes
Route::get('/list/{id}', 'PrintRequestsController@show')->name('printrequests.show');

//rota impressoes
Route::get('/list', function(){

    return view('/printrequests/list');

});



//rota login
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionsController@store');
//Route::get('/home', 'HomeController@index');
