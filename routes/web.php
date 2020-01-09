<?php

use App\Http\Middleware\CheckAdmin;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/users', 'UserController');
    Route::resource('/tasks', 'TaskController');

    Route::post('/delete_user', 'AjaxController@deleteUser');
    Route::post('/delete_tag', 'AjaxController@deleteTag');
    Route::post('/delete_task', 'AjaxController@deleteTask');
    Route::post('/delete_comment', 'AjaxController@deleteComment');
});

Route::group(['middleware' => ['auth', CheckAdmin::class]], function () {
    Route::resource('/tags', 'TagController');
    Route::resource('/comments', 'CommentController');
});
