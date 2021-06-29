<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'SchedulesController@index');
    Route::resource('users', 'UsersController');
    Route::resource('schedules', 'SchedulesController');
    
    Route::resource('projects', 'ProjectsController');
    Route::group(['prefix' => 'schedules/{id}'], function () {
        Route::post('joint_user', 'JointsController@store')->name('user.joint');
        Route::delete('unjoint_user', 'JointsController@destroy')->name('user.unjoint');
       
    });
});



