<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\Video;
use Illuminate\Http\Request;

class PlaylistController extends Controller {
	public function __construct() {
		//$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return redirect('playlist/create');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		if ($request->has('name')) {
			$name = $request->input('name');
		} else {
			$name = '';
		}

		return view('playlist', ['name' => $name]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Playlist  $playlist
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Playlist $playlist) {
		return view('playlist', ['playlist' => $playlist]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Playlist  $playlist
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Playlist $playlist) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Playlist  $playlist
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Playlist $playlist) {
		//
	}

	public function show(Playlist $playlist, Video $video = null) {
		if( is_null( $video ) )
			$index = 0;
		else
			$index = $playlist->videos->search( function( $item, $key ) use( $video ) { return $item->is( $video ); } );
		
		return view('viewer', ["index" => $index, "playlist" => $playlist]);
	}
}
