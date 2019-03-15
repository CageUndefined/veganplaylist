<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPlaylists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = new App\User;

        $user->name = 'David';
        $user->email = 'd@d.d';
        $user->password = Hash::make('imvegan');

        $user->save();

        $playlist = new App\Playlist;

        $playlist->name = 'The Best Playlist In The World';
        $playlist->creator_id = $user->id;

        $playlist->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
