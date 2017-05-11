<?php

//rota raiz
Route::get('/', 'PostsController@index');

//rota login
Route::get('/login', 'PostsController@login');

//rota detalhes
Route::get('/printrequests/{id}', 'PrintRequestsController@show')->name('printrequests.show');
