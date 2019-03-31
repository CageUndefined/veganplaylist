<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Playlist;

class UserProfileController extends Controller
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
     * Show the user profile:
     * 1. The playlist(s) they have created.
     * 2. The views on their playlist.
     * 3. Their name and when they signed up.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $playlists = $user->playlists->where('active', 1);

        return view( 'profile', [ 'user' => $user, 'playlists' => $playlists ] );
    }
}
