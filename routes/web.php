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

Route::get('/viewer', function () {

	// Really this should be passing a playlist and a position in it, and
	// it wouldn't be hard-coded.

	$id = "1igmzkmTv6U";

	$video = [
		"id" => $id,
		"title" => "You Are Lisa Simpson",
		"aspectRatio" => "4by3",
		"length" => 109,
		"src" => "https://invidio.us/embed/".$id
	];

	return view('viewer', ["video" =>  $video]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
