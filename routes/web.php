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
	
	//Clear Cache facade value:
	Route::get('/clear-cache', function() {
		$exitCode = Artisan::call('cache:clear');
		return '<h1>Cache facade value cleared</h1><pre>' . Artisan::output() . '</pre>';
	});

	//Reoptimized class loader:
	Route::get('/optimize', function() {
		$exitCode = Artisan::call('optimize');
		return '<h1>Reoptimized class loader</h1><pre>' . Artisan::output() . '</pre>';
	});

	//Route cache:
	Route::get('/route-cache', function() {
		$exitCode = Artisan::call('route:cache');
		return '<h1>Routes cached</h1><pre>' . Artisan::output() . '</pre>';
	});

	//Clear Route cache:
	Route::get('/route-clear', function() {
		$exitCode = Artisan::call('route:clear');
		return '<h1>Route cache cleared</h1><pre>' . Artisan::output() . '</pre>';
	});

	//Clear View cache:
	Route::get('/view-clear', function() {
		$exitCode = Artisan::call('view:clear');
		return '<h1>View cache cleared</h1><pre>' . Artisan::output() . '</pre>';
	});

	//Clear Config cache:
	Route::get('/config-cache', function() {
		$exitCode = Artisan::call('config:cache');
		return '<h1>Config cache cleared</h1><pre>' . Artisan::output() . '</pre>';
	});
	
	//Migrate database
	Route::get('/migrate', function() {
		$exitCode = Artisan::call('migrate');
		return '<h1>Database migrated</h1><pre>' . Artisan::output() . '</pre>';
	});
		
	//Reset and migrate database
	Route::get('/migrate-fresh', function() {
		$exitCode = Artisan::call('migrate:fresh');
		return '<h1>Database reset and migrated</h1><pre>' . Artisan::output() . '</pre>';
	});
	
}