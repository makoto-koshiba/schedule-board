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

Route::get('/', function () {
    return view('welcome');
    Route::get('登録', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('登録', 'Auth\RegisterController@register')->name('signup.post');
Route::get('ログイン', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('ログイン', 'Auth\LoginController@login')->name('login.post');
Route::get('ログイン', 'Auth\LoginController@logout')->name('logout.get');
});
