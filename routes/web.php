<?php


//rota raiz
Route::get('/', 'InicialController@index')->name('home');


//rota detalhes
Route::get('/list/{id}', 'PrintRequestsController@show')->name('printrequests.show');

//rota impressoes
Route::get('/list','PrintRequestsController@list')->name('list');

//rota criar request
Route::get('/create','PrintRequestsController@create')->name('create');
Route::post('/store','PrintRequestsController@store')->name('printrequests.store');

//rota edit request
Route::get('list/{request}/edit', 'PrintRequestsController@edit')->name('printrequests.edit');
Route::post('/list/{request}', 'PrintRequestsController@update')->name('printrequests.update');

//rota delete request
Route::delete('/list/{id}', 'PrintRequestsController@destroy')
    ->name('printrequests.destroy');

Route::get('/departmentStatistics','InicialController@departmentStatistics')->name('layout.departmentStatistics');

//rota users
Route::get('/register', 'UserController@create')->name('register');
Route::post('/register', 'UserController@store')->name('register');
Route::get('/register/confirm/{token}', 'UserController@confirmEmail')->name('confirmEmail');

Route::get('/index', 'UserController@index')->name('index');

Route::get('/login', 'UserController@login_get');
Route::post('/login','UserController@login_post');

Route::get('/logout', 'UserController@logout')->name('logout');;
//Route::get('/home', 'HomeController@index');

Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/profile_avatar', 'UserController@update_avatar')->name('update_avatar');
Route::post('/profile', 'UserController@update_profile')->name('update_profile');

//list
Route::get('users/{user}/edit', 'UserController@edit')
    ->name('users.edit');

Route::delete('users/{user}', 'UserController@destroy')
    ->name('users.destroy');

Route::post('users/{user}/edit', 'UserController@update')
        ->name('users.update');


Route::get('/list/{id}/download', 'PrintRequestsController@download')->name('printrequests.download');

Route::post('/list/{id}/complete', 'PrintRequestsController@setComplete')->name('printrequests.complete');

Route::post('/list/{id}/rate', 'PrintRequestsController@setRating')->name('printrequests.setRating');

Route::get('/list/{requestID}/block/{commentID}', 'CommentsController@block')->name('comments.block');

Route::post('/list/{requestID}/create/{commentID?}', 'CommentsController@createComment')->name('comments.create');

Route::post('/list/{id}/refuseRequest', 'PrintRequestsController@refuseRequest')->name('printrequests.refuseRequest');

Route::get('/list-{criteria}-{order}','PrintRequestsController@order')->name('printrequests.order');

Route::get('/dashboard', 'DashboardController@list')->name('printrequests.dashboard');
