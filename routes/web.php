<?php


//rota raiz
Route::get('/', 'PostsController@index')->name('home');

//rota login
//Route::get('/login', 'PostsController@login');


//rota detalhes
Route::get('/list/{id}', 'RequestsController@show')->name('printrequests.show');

//rota impressoes
<<<<<<< HEAD
Route::get('/list','RequestsController@list');
=======
Route::get('/list', function(){

    return view('/printrequests/list');

});
>>>>>>> master



//rota login
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create');
Route::get('/logout', 'SessionsController@destroy');
//Route::get('/home', 'HomeController@index');


Route::get('/list/{id}/download', 'PrintRequestsController@download')->name('printrequests.download');
