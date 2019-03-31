<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pl = Playlist::where([
            ['creator_id', '=', 1],
            ['active', '=', 1]
        ])->limit(100)->get();
        return view( 'home', [ 'playlists' => $pl ] );
    }

    public function featured()
    {
        $pl = Playlist::where([
            ['featured', '=', true],
            [ 'active', '=', 1 ]
        ])->limit(100)->get();
        return view( 'home', [ 'playlists' => $pl ] );
    }

    public function recent()
    {
        $pl = Playlist::where( 'active', 1 )->latest()->limit(100)->get();
        return view( 'home', [ 'playlists' => $pl ] );
    }
}
