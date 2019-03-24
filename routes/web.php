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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::view('/about', 'about');

Route::resources([
    'settings' => 'UserSettingsController',
    'playlist' => 'PlaylistController',
    'playlist.video' => 'PlaylistController'
]);

if( config('app.debug') ) {
    
    Route::get( '/artisan', function() {

        Artisan::call( 'list' );
        $output = strstr( Artisan::output(), 'Available commands:' );
        $output = preg_replace( '/^(  ?)(([a-z]+:)?[a-z]+(-[a-z]+)?)/m', '\1<a href="artisan/\2">\2</a>', $output );
        return "<h1>Artisan web interface</h1><pre>$output</pre>";

    } );

	Route::get( '/artisan/{cmd}', function( $cmd ) {
		$exitCode = Artisan::call( $cmd );
		return "<h1>Executed 'artisan $cmd'</h1><pre>" . Artisan::output() . '</pre>';
	} )->where( 'cmd', '([a-z]+:)?[a-z]+(-[a-z]+)?' );

}
