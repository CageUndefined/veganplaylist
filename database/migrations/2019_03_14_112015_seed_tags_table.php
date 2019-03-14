<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tags')->insert(
            array(
                array(
                    'name' => 'Health'
                ), 
                array(
                    'name' => 'Environmental'
                ), 
                array(
                    'name' => 'Cruelty'
                ), 
                array(
                    'name' => 'Graphic'
                ), 
                array(
                    'name' => 'Ethics'
                ), 
                array(
                    'name' => 'Philosophy'
                ), 
                array(
                    'name' => 'Humor'
                ), 
                array(
                    'name' => 'Activism'
                ) 
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
