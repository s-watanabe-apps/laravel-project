<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
})->name('requestUser');

Route::get('/test/{apiToken?}', 'Api\TestController@index');
Route::post('/favorites', 'Api\FavoritesController@post');
Route::get('/show/image', 'Api\ShowController@image');
Route::get('/events', 'Api\EventsController@get');

