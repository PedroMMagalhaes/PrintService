<?php

//rota raiz
Route::get('/', 'PostsController@index');

//rota login
Route::get('/login', 'PostsController@login');

//rota detalhes
Route::get('/list/{id}', 'PrintRequestsController@show')->name('printrequests.show');

//rota impressoes
Route::get('/list');
//->middleware('auth');
