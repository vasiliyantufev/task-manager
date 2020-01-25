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

});

Route::group(['middleware' => ['auth', CheckAdmin::class]], function () {
    Route::resource('/tags', 'TagController');
    Route::resource('/comments', 'CommentController');
});
