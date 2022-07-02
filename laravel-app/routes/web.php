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

    Route::group(['middleware' => ['authcheck.readpermission']], function () {
        // Index
        Route::get('/', 'IndexController@index');

        // Articles
        Route::get('/articles', 'ArticlesController@index');
        Route::get('/articles/{id}', 'ArticlesController@get')->where('id', '[0-9]+');
        Route::group(['middleware' => ['authcheck.writepermission']], function () {
            Route::get('/articles/write', 'ArticlesController@write');
            Route::post('/articles/confirm', 'ArticlesController@confirm');
            Route::post('/articles/post', 'ArticlesController@post');
        });

        // Profiles
        Route::group(['middleware' => ['authcheck.writepermission']], function () {
            Route::get('/members', 'ProfilesController@index');
            Route::get('/profiles/{id}', 'ProfilesController@get')->where('id', '[0-9]+')->name('profiles.get');
            Route::get('/profiles/edit', 'ProfilesController@edit');
            Route::post('/profiles/post', 'ProfilesController@post');
        });

        // Pictures
        Route::get('/pictures', 'PicturesController@index');
        Route::get('/pictures/{id}', 'PicturesController@get')->where('id', '[0-9]+');

        // Messages
        Route::get('/messages/inbox', 'MessagesController@inbox');
        Route::get('/messages/{id}', 'MessagesController@get')->where('id', '[0-9]+');

        // Favorites
        Route::get('/favorites', 'FavoritesController@index')->name('favorites');
        Route::get('/favorites/remove/{uri}', 'FavoritesController@remove')->where('uri', '.*');

        // Schedule
        Route::get('/schedule', 'ScheduleController@index');

        // Show storage
        Route::get('/show/image', 'ShowController@image');

        // Managements
        Route::group(['prefix' => 'managements', 'name' => 'managements.', 'middleware' => ['admincheck']], function () {
            // Settings
            Route::get('settings', 'Managements\SettingsController@index')->name('managementsSettings');
            Route::post('settings/post', 'Managements\SettingsController@post');

            // Users
            Route::get('users', 'Managements\UsersController@index')->name('managementsUsers');
            Route::get('users/create', 'Managements\UsersController@create');
            Route::post('users/confirm', 'Managements\UsersController@confirm');
            Route::post('users/post', 'Managements\UsersController@post');

            // Informations
            Route::get('informations', 'Managements\InformationsController@index')->name('managementsInformations');
            Route::get('informations/create', 'Managements\InformationsController@create');
            Route::post('informations/confirm', 'Managements\InformationsController@confirm');
            Route::post('informations/post', 'Managements\InformationsController@post');
            Route::get('informations/{id}', 'Managements\InformationsController@get')->where('id', '[0-9]+');

            // Profile Settings
            Route::get('profile/settings', 'Managements\ProfileSettingsController@index')->name('managementsProfileSettings');
            Route::post('profile/settings/post', 'Managements\ProfileSettingsController@post');
        });
    });
});

// Other route
Route::fallback(function(){
    return view('errors/404');
});
//Auth::routes();
