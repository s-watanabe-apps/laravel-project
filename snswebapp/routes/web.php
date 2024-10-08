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
    // 認証系
    Route::get('/login', 'Auth\LoginController@loginGet')->name('login');
    Route::post('/login', 'Auth\LoginController@loginPost');
    Route::get('/logout', 'Auth\LogoutController@index');
    Route::get('/password/email', 'Auth\PasswordController@email');
    Route::post('/password/email', 'Auth\PasswordController@sendResetMail');
    Route::get('/password/reset', 'Auth\PasswordController@reset');
    Route::post('/password/reset', 'Auth\PasswordController@resetPassword');

    // 会員登録
    Route::get('/register', 'AppRegisterController@index');
    Route::post('/register', 'AppRegisterController@index');

    Route::group(['middleware' => ['authcheck.readpermission']], function () {
        // トップページ
        Route::get('/', 'IndexController@index');

        // マイページ
        Route::get('/mypage', 'MypageController@index');
        Route::get('/mypage/password', 'MypageController@password');

        // 記事
        Route::get('/articles', 'ArticlesController@index');
        Route::get('/articles/user/{id}', 'ArticlesController@user')->where('id', '[0-9]+')->name('articles.user');
        Route::get('/articles/{id}', 'ArticlesController@get')->where('id', '[0-9]+')->name('articles.get');
        Route::group(['middleware' => ['authcheck.writepermission']], function () {
            Route::get('/articles/write', 'ArticlesController@write');
            Route::get('/articles/edit/{id}', 'ArticlesController@edit');
            Route::post('/articles/confirm', 'ArticlesController@createConfirm');
            Route::put('/articles/confirm', 'ArticlesController@editConfirm');
            Route::post('/articles/save', 'ArticlesController@post');
            Route::put('/articles/save', 'ArticlesController@put');
            Route::get('/articles/delete/{id}', 'ArticlesController@deleteConfirm')->where('id', '[0-9]+');
            Route::delete('/articles/delete', 'ArticlesController@delete');
            Route::post('/articles/comment', 'ArticlesController@comment');
        });

        // プロフィール
        Route::get('/members', 'ProfilesController@index');
        Route::get('/profiles/{id}', 'ProfilesController@get')->where('id', '[0-9]+')->name('profiles.get');
        Route::group(['middleware' => ['authcheck.writepermission']], function () {
            Route::get('/profiles/edit', 'ProfilesController@edit');
            Route::put('/profiles/save', 'ProfilesController@save');
        });

        // アルバム
        Route::get('/album', 'PicturesController@index')->name('pictures.index');
        Route::get('/album/{id}', 'PicturesController@get')->where('id', '[0-9]+')->name('pictures.get');
        Route::group(['middleware' => ['authcheck.writepermission']], function () {
            Route::get('/album/upload', 'PicturesController@upload');
            Route::post('/album/post', 'PicturesController@post');
            Route::post('/album/comment', 'PicturesController@comment');
            Route::get('/album/{id}/comment/{comment_id}', 'PicturesController@editComment')
                ->where('id', '[0-9]+')
                ->where('comment_id', '[0-9]+');
        });

        // メッセージ
        Route::get('/messages/inbox', 'MessagesController@inbox');
        Route::get('/messages/{id}', 'MessagesController@get')->where('id', '[0-9]+');

        // お気に入り
        Route::get('/favorites', 'FavoritesController@index')->name('favorites');
        Route::get('/favorites/remove/{uri}', 'FavoritesController@remove')->where('uri', '.*');

        // スケジュール
        Route::get('/schedule', 'ScheduleController@index');

        // フリーページ
        Route::get('/page/{code}', 'PageController@get')->where('code', '[a-zA-Z0-9]{32}');

        // ストレージ
        Route::get('/show/image', 'ShowController@image');

        // ファイル
        Route::get('/files/{fileName}', 'FilesController@get')->where('fileName', \App\Services\FilesService::getRegex());

        // お問い合わせ
        Route::get('/inquiry', 'InquiryController@index');
        Route::post('/inquiry/confirm', 'InquiryController@confirm');
        Route::post('/inquiry/send', 'InquiryController@send');
        Route::get('/inquiry/complete', 'InquiryController@complete')->name('inquiryComplete');

        // 管理者メニュー
        Route::group(['prefix' => 'managements', 'name' => 'managements.', 'middleware' => ['admincheck']], function () {
            // 設定
            Route::get('settings', 'Managements\SettingsController@index')->name('managementsSettings');
            Route::post('settings', 'Managements\SettingsController@save');

            // ユーザー管理
            Route::get('users', 'Managements\UsersController@index')->name('managementsUsers');
            Route::get('users/{id}', 'Managements\UsersController@get')->where('id', '[0-9]+');
            Route::get('users/create', 'Managements\UsersController@create');
            Route::post('users/confirm', 'Managements\UsersController@confirm');
            Route::post('users/sendmail', 'Managements\UsersController@sendmail');

            // グループ管理
            Route::get('groups', 'Managements\GroupsController@index')->name('managementsGroups');

            // ナビゲーション管理
            Route::get('navigations', 'Managements\NavigationMenusController@index')->name('managementsNavigations');
            Route::post('navigations', 'Managements\NavigationMenusController@save');

            // お知らせ管理
            Route::get('informations', 'Managements\InformationsController@index')->name('managementsInformations');
            Route::get('informations/{id}', 'Managements\InformationsController@get')->where('id', '[0-9]+');
            Route::get('informations/create', 'Managements\InformationsController@create');
            Route::post('informations/confirm', 'Managements\InformationsController@createConfirm');
            Route::post('informations/save', 'Managements\InformationsController@post');
            Route::get('informations/edit/{id}', 'Managements\InformationsController@edit')->where('id', '[0-9]+');
            Route::put('informations/confirm', 'Managements\InformationsController@editConfirm');
            Route::put('informations/save', 'Managements\InformationsController@put');
            Route::get('informations/delete/{id}', 'Managements\InformationsController@delete')->where('id', '[0-9]+');

            // プロフィール項目管理
            Route::get('profile/settings', 'Managements\ProfileSettingsController@index')->name('managementsProfileSettings');
            Route::post('profile/settings', 'Managements\ProfileSettingsController@save');

            // フリーページ管理
            Route::get('freepages', 'Managements\FreePagesController@index')->name('managementsFreepages');
            Route::get('freepages/{id}', 'Managements\FreePagesController@get')->where('id', '[0-9]+');
            Route::get('freepages/create', 'Managements\FreePagesController@create');
            Route::post('freepages/confirm', 'Managements\FreePagesController@createConfirm');
            Route::post('freepages/save', 'Managements\FreePagesController@post');
            Route::put('freepages/confirm', 'Managements\FreePagesController@editConfirm');
            Route::put('freepages/save', 'Managements\FreePagesController@put');

            // ファイルアップロード
            Route::get('uploadfiles', 'Managements\UploadfilesController@index')->name('managementsUploadfiles');
            Route::post('uploadfiles', 'Managements\UploadfilesController@uploadFile');

            // 広告管理
            Route::get('ads', 'Managements\AdsController@index')->name('managementsAds');
            Route::post('ads/save', 'Managements\AdsController@save');

            // お問い合わせ種別管理
            Route::get('inquiry/types', 'Managements\InquiryTypesController@index')->name('managementsInquiryTypes');
            Route::post('inquiry/types/save', 'Managements\InquiryTypesController@save');

            // お問い合わせ管理
            Route::get('inquiries', 'Managements\InquiriesController@index');
            Route::get('inquiries/{id}', 'Managements\InquiriesController@get')->where('id', '[0-9]+');
        });
    });
});

// ルーティングエラー
Route::fallback(function(){
    return view('errors/404');
});
//Auth::routes();
