<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::model('notification', 'Notification');

Route::get('/', function () {
    return view('front.welcome');
});

Route::post('/formpost', [
    'as' => 'formpost',
    'uses' => 'HomeController@store'
]);

Route::get('register/verify/{confirmation_code}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);

Route::group(['prefix' => 'administrator'], function () {

    Route::get('/', function () {
        return view ('auth.login');
    });

    Route::get('/index', 'AdministratorController@showAll');

    Route::get('/details/{id}', [
        'as' => 'details',
        'uses' => 'AdministratorController@details'
    ]);

    Auth::routes();
});

Route::get('/home', 'HomeController@index');
