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

    $playlist = App\Playlist::find(1);

    return view('viewer', ["index" => $index, "playlist" => $playlist]);
})
    ->where(['index' => '[0-9]?'])
    ->name('viewer');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'settings' => 'UserSettingsController',
    'playlist' => 'PlaylistController'
]);

if( config('app.debug') ) {
    
    Route::get( '/artisan', function() {

        Artisan::call( 'list' );
        $output = strstr( Artisan::output(), 'Available commands:' );
        $output = preg_replace( '/^  ?(([a-z]+:)?[a-z]+(-[a-z]+)?)/m', '<a href="artisan/\1">\1</a>', $output );
        return "<h1>Artisan web interface</h1><pre>$output</pre>";

    } );

	//Clear Cache facade value:
	Route::get( '/artisan/{cmd}', function( $cmd ) {
		$exitCode = Artisan::call( $cmd );
		return "<h1>Executed 'artisan $cmd'</h1><pre>" . Artisan::output() . '</pre>';
	})->where( 'cmd', '([a-z]+:)?[a-z]+(-[a-z]+)?' );

}
