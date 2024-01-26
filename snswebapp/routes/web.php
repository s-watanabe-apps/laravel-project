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
    Route::get('/password/reset', 'Auth\ForgotPasswordController@reset');
    Route::post('/password/reset', 'Auth\ForgotPasswordController@resetPassword');
    Route::get('/register', 'AppRegisterController@index');
    Route::post('/register', 'AppRegisterController@index');

    Route::group(['middleware' => ['authcheck.readpermission']], function () {
        // Index
        Route::get('/', 'IndexController@index');

        // Articles
        Route::get('/articles', 'ArticlesController@index');
        Route::get('/articles/user/{id}', 'ArticlesController@user')->where('id', '[0-9]+')->name('articles.user');
        Route::get('/articles/{id}', 'ArticlesController@get')->where('id', '[0-9]+')->name('articles.get');
        Route::group(['middleware' => ['authcheck.writepermission']], function () {
            Route::get('/articles/write', 'ArticlesController@write');
            Route::get('/articles/edit/{id}', 'ArticlesController@edit');
            Route::post('/articles/confirm', 'ArticlesController@createConfirm');
            Route::put('/articles/confirm', 'ArticlesController@confirm');
            Route::post('/articles/register', 'ArticlesController@register');
            Route::put('/articles/register', 'ArticlesController@register');
            Route::post('/articles/comment', 'ArticlesController@comment');
        });

        // Profiles
        Route::get('/members', 'ProfilesController@index');
        Route::get('/profiles/{id}', 'ProfilesController@get')->where('id', '[0-9]+')->name('profiles.get');
        Route::group(['middleware' => ['authcheck.writepermission']], function () {
            Route::get('/profiles/edit', 'ProfilesController@edit');
            Route::put('/profiles/register', 'ProfilesController@register');
        });

        // Pictures
        Route::get('/pictures', 'PicturesController@index')->name('pictures.index');
        Route::get('/pictures/{id}', 'PicturesController@get')->where('id', '[0-9]+')->name('pictures.get');
        Route::group(['middleware' => ['authcheck.writepermission']], function () {
            Route::get('/pictures/upload', 'PicturesController@upload');
            Route::post('/pictures/post', 'PicturesController@post');
            Route::post('/pictures/comment', 'PicturesController@comment');
            Route::get('/pictures/{id}/comment/{comment_id}', 'PicturesController@editComment')
                ->where('id', '[0-9]+')
                ->where('comment_id', '[0-9]+');
        });

        // Messages
        Route::get('/messages/inbox', 'MessagesController@inbox');
        Route::get('/messages/{id}', 'MessagesController@get')->where('id', '[0-9]+');

        // Favorites
        Route::get('/favorites', 'FavoritesController@index')->name('favorites');
        Route::get('/favorites/remove/{uri}', 'FavoritesController@remove')->where('uri', '.*');

        // Schedule
        Route::get('/schedule', 'ScheduleController@index');

        // Free Page
        Route::get('/page/{code}', 'PageController@get')->where('code', '[a-zA-Z0-9]{32}');

        // Show storage
        Route::get('/show/image', 'ShowController@image');

        // Files
        Route::get('/files/{fileName}', 'FilesController@get')->where('fileName', \App\Services\FilesService::getRegex());


        // Managements
        Route::group(['prefix' => 'managements', 'name' => 'managements.', 'middleware' => ['admincheck']], function () {
            // Settings
            Route::get('settings', 'Managements\SettingsController@index')->name('managementsSettings');
            Route::post('settings/register', 'Managements\SettingsController@register');

            // Users
            Route::get('users', 'Managements\UsersController@index')->name('managementsUsers');
            Route::get('users/create', 'Managements\UsersController@create');
            Route::post('users/confirm', 'Managements\UsersController@confirm');
            Route::post('users/register', 'Managements\UsersController@register');

            // Groups
            Route::get('groups', 'Managements\GroupsController@index')->name('managementsGroups');

            // Navigation Menus
            Route::get('navigations', 'Managements\NavigationMenusController@index')->name('managementsNavigations');
            Route::post('navigations/register', 'Managements\NavigationMenusController@register');

            // Informations
            Route::get('informations', 'Managements\InformationsController@index')->name('managementsInformations');
            Route::get('informations/{id}', 'Managements\InformationsController@get')->where('id', '[0-9]+');
            Route::get('informations/create', 'Managements\InformationsController@create');
            Route::post('informations/confirm', 'Managements\InformationsController@confirm');
            Route::post('informations/register', 'Managements\InformationsController@register');
            Route::put('informations/confirm', 'Managements\InformationsController@confirm');
            Route::put('informations/register', 'Managements\InformationsController@register');

            // Profile Settings
            Route::get('profile/settings', 'Managements\ProfileSettingsController@index')->name('managementsProfileSettings');
            Route::post('profile/settings/register', 'Managements\ProfileSettingsController@register');

            // Free Pages
            Route::get('freepages', 'Managements\FreepagesController@index')->name('managementsFreepages');
            Route::get('freepages/{id}', 'Managements\FreepagesController@get')->where('id', '[0-9]+');
            Route::get('freepages/create', 'Managements\FreepagesController@create');
            Route::post('freepages/confirm', 'Managements\FreepagesController@confirm');
            Route::post('freepages/register', 'Managements\FreepagesController@register');
            Route::put('freepages/confirm', 'Managements\FreepagesController@confirm');
            Route::put('freepages/register', 'Managements\FreepagesController@register');

            // Upload files
            Route::get('uploadfiles', 'Managements\UploadfilesController@index')->name('managementsUploadfiles');
        });
    });
});

// Other route
Route::fallback(function(){
    return view('errors/404');
});
//Auth::routes();
