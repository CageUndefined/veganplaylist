<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        $user = new App\User;
        $user->name = 'Vegan Playlist';
        $user->email = 'contact@youaretheirvoice.com';
        $user->password = Hash::make('1mT3hUlt!m@t3VeG4Nn');
        $user->save();
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
