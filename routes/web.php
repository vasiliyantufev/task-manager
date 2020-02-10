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
    Route::resource('/comments', 'CommentController');
});

Route::group(['middleware' => ['auth', CheckAdmin::class]], function () {
    Route::resource('/tags', 'TagController');
});

Route::get('localization/{locale}', 'LocalizationController@index')->name('localization');
