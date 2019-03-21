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
});

Route::get( '/search', 'SearchController@search' );
Route::get( '/search/tag/{tags}', 'SearchController@search_tags' );
Route::get( '/search/title/{name}', 'SearchController@search_title' );
