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
    return view('home');
});

Route::get('viewer/{index?}', function ($index = null) {

    $videos = App\Video::whereIn('id', array(1, 2, 3, 4))->get();

    return view('viewer', ["videos" => $videos, "index" => $index]);
})
    ->where(['index' => '[0-9]?'])
    ->name('viewer');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/settings', function () {
    return view('settings');
})
    ->name('settings');
