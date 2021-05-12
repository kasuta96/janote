<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Note::class, function ($faker) {
    return [
        'title' => $faker->city,
        'content' => $faker->word,
        'user_id' => 1,
        'category_id' => random_int(1, 12),
        // 'audio',
        // 'image'
    ];
});
