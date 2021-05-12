<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function ($faker) {
    return [
        'content' => $faker->realText,
        'user_id' => random_int(1, 11),
        'embed' => $faker->url
    ];
});
