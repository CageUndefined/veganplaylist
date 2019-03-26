<?php

use Illuminate\Database\Migrations\Migration;

class SeedVideos2 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {

        $videos = array(
			array(
				'service' => 'v',
				'service_video_id' => '192022751',
				'title' => 'You Will Be Sold To',
				'length' => 30,
                'widescreen' => true,
                'graphic' => true,
                'mature' => true
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
	public function down() {
		//
	}
}
