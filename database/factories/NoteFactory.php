<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Note::class, function ($faker) {
    return [
        'title' => $faker->city,
        'content' => $faker->word,
        'user_id' => \App\User::first()->id,
        'category_id' => \App\Models\Category::first()->id
        // 'audio',
        // 'image'
    ];
});
