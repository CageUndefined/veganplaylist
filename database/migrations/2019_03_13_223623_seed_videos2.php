<?php

use Illuminate\Database\Migrations\Migration;

class SeedVideos2 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::table('videos')->insert(
			array(
				'service' => 'v',
				'service_video_id' => '192022751',
				'title' => 'You Will Be Sold To',
				'length' => 30,
				'widescreen' => true,
			)
		);
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
