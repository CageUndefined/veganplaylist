<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $videos = array(
            array(
                'service' => 'y',
                'service_video_id' => '1igmzkmTv6U',
                'title' => 'You Are Lisa Simpson',
                'length' => 109,
                'widescreen' => false,
                'graphic' => false,
                'mature' => true
            ),
            array(
                'service' => 'y',
                'service_video_id' => 'Sczb1dnRXCY',
                'title' => 'Nelson Laughs at the Very Tall',
                'length' => 88,
                'widescreen' => true,
                'graphic' => true,
                'mature' => false
            ),
            array(
                'service' => 'y',
                'service_video_id' => 'Ul6UcvNX4o8',
                'title' => 'I Sleep in a Racing Car!',
                'length' => 8,
                'widescreen' => false,
                'graphic' => false,
                'mature' => false
            )
        );

        foreach( $videos as $entry ) {

            $video = App\Video::create( $entry );
            $video->save();

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
