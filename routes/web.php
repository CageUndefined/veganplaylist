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

Route::get('viewer/{index?}', function($index = null){

	// imagine we're pulling all of the following out of the DB
	$id1 = "1igmzkmTv6U";
	$id2 = "Sczb1dnRXCY";
	$id3 = "Ul6UcvNX4o8";

	$videos = [
		[
			"id" => $id1,
			"title" => "You Are Lisa Simpson",
			"aspectRatio" => "4by3",
			"length" => 109,
			"src" => "https://invidio.us/embed/".$id1,
			"thumbnailSrc" => "https://img.youtube.com/vi/".$id1."/hqdefault.jpg",
			"path" => "/viewer/0"
		],[
			"id" => $id2,
			"title" => "Nelson Laughs at the Very Tall",
			"aspectRatio" => "16by9",
			"length" => 88,
			"src" => "https://invidio.us/embed/".$id2,
			"thumbnailSrc" => "https://img.youtube.com/vi/".$id2."/hqdefault.jpg",
			"path" => "/viewer/1"
		],[
			"id" => $id3,
			"title" => "I Sleep in a Racing Car!",
			"aspectRatio" => "4by3",
			"length" => 8,
			"src" => "https://invidio.us/embed/".$id3,
			"thumbnailSrc" => "https://img.youtube.com/vi/".$id3."/hqdefault.jpg",
			"path" => "/viewer/2"
		]
	];

	return view('viewer', ["videos" =>  $videos, "index" => $index]);
})
->where(['index' => '[0-9]?'])
->name('viewer');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
