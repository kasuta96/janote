<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function ($faker) {
    return [
        'content' => $faker->realText,
        'user_id' => \App\User::inRandomOrder()->first()->id,
        'embed' => $faker->url
    ];
});
