<?php

use Illuminate\Database\Migrations\Migration;

class NewViewsColumn extends Migration {
	/**
	 * Run the migrations.
	 *p
	 * @return void
	 */
	public function up() {
		// Schema::table('playlists', function (Blueprint $table) {
		// 	$table->bigInteger('views')->default(0);
		// });
		// Schema::table('playlist_video_map', function (Blueprint $table) {
		// 	$table->dropColumn('views');
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		// Schema::table('playlist_video_map', function (Blueprint $table) {
		// 	$table->bigInteger('views')->default(0);
		// });
		// Schema::table('playlists', function (Blueprint $table) {
		// 	$table->dropColumn('views');
		// });
	}
}
