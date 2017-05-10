<?php

//rota raiz
Route::get('/', 'PostsController@index');

//rota login
Route::get('/login', 'PostsController@login');
