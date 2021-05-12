<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function ($faker) {
    return [
        'title' => $faker->company,
        'user_id' => 1
    ];
});
