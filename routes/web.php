<?php


//rota raiz
Route::get('/', 'InicialController@index')->name('home');


//rota detalhes
Route::get('/list/{id}', 'PrintRequestsController@show')->name('printrequests.show');

Route::get('/list/{id}/download', 'PrintRequestsController@download')->name('printrequests.download');

Route::post('/list/{id}/complete', 'PrintRequestsController@setComplete')->name('printrequests.complete');

Route::post('/list/{id}/rate', 'PrintRequestsController@setRating')->name('printrequests.setRating');

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

//comments
Route::get('/comments/manageComments','CommentsController@showBlockedComments')->name('manageComments');
Route::get('/list/{requestID}/block/{commentID}', 'CommentsController@block')->name('comments.block');
Route::get('/comments/manageComments/{commentID}','CommentsController@unblockComments')->name('comments.unblock');

Route::post('/list/{requestID}/create/{commentID?}', 'CommentsController@createComment')->name('comments.create');
Route::post('/list/{id}/refuseRequest', 'PrintRequestsController@refuseRequest')->name('printrequests.refuseRequest');
Route::get('/list-{criteria}-{order}','PrintRequestsController@order')->name('printrequests.order');
Route::get('/index-{criteria}-{order}','UserController@order')->name('contacts.order');
Route::get('image/{ownerID}/{filename}', 'PrintRequestsController@showRequestImage')->name('printrequests.displayImage');

//statistics
Route::get('/departmentStatistics/{id}','InicialController@departmentStatistics')->name('layout.departmentStatistics');

//rota users
Route::get('/register', 'UserController@create')->name('register');
Route::post('/register', 'UserController@store')->name('register');
Route::get('/register/confirm/{token}', 'UserController@confirmEmail')->name('confirmEmail');

Route::get('/index', 'UserController@index')->name('index');

Route::get('/login', 'UserController@login_get')->name('login');
Route::post('/login','UserController@login_post');

Route::get('/logout', 'UserController@logout')->name('logout');;


Route::get('/profile', 'UserController@profile')->name('profile');
Route::get('/user/profile/{id}', 'UserController@showProfile')->name('showProfile');
Route::post('/profile_avatar', 'UserController@update_avatar')->name('update_avatar');
Route::post('/profile', 'UserController@update_profile')->name('update_profile');

//list
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');

Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');

Route::post('users/{user}/edit', 'UserController@update')->name('users.update');

Route::get('/users/manage/users','UserController@showBlokedUsers')->name('users.manageblock');
Route::get('/users/manageBlock/users/block/{id}','UserController@blockUser')->name('users.block');
Route::get('/users/manageBlock/users/unblock/{id}','UserController@unblockUser')->name('users.unblock');

Route::get('/users/manageRole/users','UserController@showUsersRole')->name('users.managerole');
Route::get('/users/manageRole/users/givepermissions/{id}','UserController@givePrivileges')->name('users.getAdmin');
Route::get('/users/manageRole/users/removepermissions/{id}','UserController@removePrivileges')->name('users.removeAdmin');


// Password Reset Routes...
Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
Route::post('password/reset', 'ResetPasswordController@reset');
