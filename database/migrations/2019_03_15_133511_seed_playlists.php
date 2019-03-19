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
        $playlist->featured = true;
        $playlist->save();

        $videos = App\Video::whereIn('id', array(1, 2, 3, 4))->get();

        $order = 0;

        foreach ($videos as $video) {
            DB::table('playlist_video_map')->insert(
                array(
                    array(
                        'playlist_id' => $playlist->id,
                        'video_id' => $video->id,
                        'order' => $order++
                    )
                )
            );
        }
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
