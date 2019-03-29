<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Migrations\Migration;
use Faker\Provider\Lorem;

class SeedPlaylists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        return;
        for( $i = 0; $i < 9; $i++ ) {

            $playlist = new App\Playlist;

            $playlist->name = ucwords( rtrim( Lorem::text(50), '.' ) );
            $playlist->creator_id = 1;
            $playlist->save();

            $videos = App\Video::inRandomOrder()->take( rand( 4, 10 ) )->get();
            $order = 0;

            foreach ($videos as $video)
                $playlist->videos()->attach( $video->id, [ 'order' => $order++ ] );

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
