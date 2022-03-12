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

Route::group(['middleware' => ['settings', 'auth.basic']], function() {
    // Authenticate
    Route::get('/login', 'Auth\LoginController@loginGet')->name('login');
    Route::post('/login', 'Auth\LoginController@loginPost');
    Route::get('/logout', 'Auth\LogoutController@index');
    Route::get('/password/email', 'Auth\ForgotPasswordController@index');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetMail');
    //Route::get('/password/reset', 'Auth\ForgotPasswordController@reset');
    Route::get('/register', 'AppRegisterController@index');
    Route::post('/register', 'AppRegisterController@index');

    Route::group(['middleware' => ['authcheck']], function () {
        // Index
        Route::get('/', 'IndexController@index');

        // Articles
        Route::get('/articles', 'ArticlesController@index');
        Route::get('/articles/{id}', 'ArticlesController@get')->where('id', '[0-9]+');
        Route::get('/articles/write', 'ArticlesController@write');
        Route::post('/articles/confirm', 'ArticlesController@confirm');
        Route::post('/articles/post', 'ArticlesController@post');

        // Profiles
        Route::get('/members', 'ProfilesController@index');
        Route::get('/profiles/{id}', 'ProfilesController@get')->where('id', '[0-9]+')->name('profiles.get');
        Route::get('/profiles/edit', 'ProfilesController@edit');
        Route::post('/profiles/post', 'ProfilesController@post');

        // Pictures
        Route::get('/pictures', 'PicturesController@index');
        Route::get('/pictures/{id}', 'PicturesController@get')->where('id', '[0-9]+');

        // Messages
        Route::get('/messages/inbox', 'MessagesController@inbox');
        Route::get('/messages/{id}', 'MessagesController@get')->where('id', '[0-9]+');

        // Favorites
        Route::get('/favorites', 'FavoritesController@index')->name('favorites');
        Route::get('/favorites/remove/{uri}', 'FavoritesController@remove')->where('uri', '.*');

        // Show storage
        Route::get('/show/image', 'ShowController@image');

        // Management settings
        Route::get('managements/settings', 'Managements\SettingsController@index')->name('managementsSettings');
        Route::post('managements/settings/post', 'Managements\SettingsController@post');

        // Management users
        Route::get('managements/users', 'Managements\UsersController@index')->name('managementsUsers');
        Route::get('managements/users/create', 'Managements\UsersController@create');
        Route::post('managements/users/confirm', 'Managements\UsersController@confirm');
        Route::post('managements/users/post', 'Managements\UsersController@post');

        // Management informations
        Route::get('managements/informations', 'Managements\InformationsController@index')->name('managementsInformations');
        Route::get('managements/informations/create', 'Managements\InformationsController@create');
        Route::post('managements/informations/confirm', 'Managements\InformationsController@confirm');
        Route::post('managements/informations/post', 'Managements\InformationsController@post');
        Route::get('managements/informations/{id}', 'Managements\InformationsController@get')->where('id', '[0-9]+');
    });
});

// Other route
Route::fallback(function(){
    return view('errors/404');
});
//Auth::routes();
