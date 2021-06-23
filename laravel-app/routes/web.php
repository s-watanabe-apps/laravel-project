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

Route::get('/login', 'AppLoginController@index')->name('login');
Route::post('/login', 'AppLoginController@index');
Route::get('/', 'IndexController@index');
Route::get('/register', 'AppRegisterController@index');
Route::post('/register', 'AppRegisterController@index');
Route::get('/logout', 'LogoutController@index');
