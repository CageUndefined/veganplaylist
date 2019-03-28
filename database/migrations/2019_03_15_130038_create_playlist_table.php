<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('playlists', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('slug')->unique();

			$table->unsignedBigInteger('creator_id')->nullable();
			$table->foreign('creator_id')->references('id')->on('users');
			$table->boolean('featured')->default(false);
			$table->bigInteger('views')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('playlists');
	}
}
