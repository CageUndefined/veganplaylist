<?php

use Faker\Generator as Faker;

$factory->define(App\Video::class, function (Faker $faker) {
    return [
        'service' => $faker->randomElement( array('y','v') ),
        'service_video_id' => Str::random(10),
        'title' => $faker->text(15),
        'length' => $faker->numberBetween(30, 900),
        'widescreen' => $faker->boolean(50),
        'graphic' => $faker->boolean(50),
        'mature' => $faker->boolean(50),
    ];
});
